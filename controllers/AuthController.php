<?php


namespace app\controllers;


use app\helpers\MailSendHelper;
use app\models\forms\PasswordResetForm;
use app\models\forms\SignUpForm;
use app\models\forms\SignInForm;
use app\models\User;
use app\services\TokenService;
use Throwable;
use Yii;
use yii\base\Exception;
use yii\base\InvalidConfigException;
use yii\base\Module;
use yii\db\StaleObjectException;
use yii\rest\Controller;
use yii\web\BadRequestHttpException;
use yii\web\Response;

class AuthController extends Controller
{
    /**
     * @var TokenService
     */
    private $tokenService;


    /**
     * AuthController constructor.
     * @param string $id
     * @param Module $module
     * @param TokenService $tokenService
     * @param array $config
     */
    public function __construct(string $id, Module $module, TokenService $tokenService, $config = [])
    {
        $this->tokenService = $tokenService;
        parent::__construct($id, $module, $config);
    }
    /**
     * {@inheritdoc}
     */
    protected function verbs(): array
    {
        return [
            'sign-up' => ['POST'],
            'sign-in' => ['POST'],
            'reset-password' => ['POST'],
            'confirm' => ['GET'],
        ];
    }

    /**
     * @return SignUpForm
     * @throws BadRequestHttpException
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionSignUp(): SignUpForm
    {
        $model = new SignUpForm();
        $model->setScenario(SignUpForm::SCENARIO_FROM_SITE);
        $model->load(Yii::$app->request->getBodyParams(), '');
        $model->from = User::FROM_SITE;
        if ($model->register()) {
            $token = $this->tokenService->generateEmailConfirmationToken($model->id);
            $token->save();
            MailSendHelper::sendEmailConfirmationMessage($model->email, $token->code);
            return $model;
        }
        throw new BadRequestHttpException('Неизвестная ошибка');
    }

    /**
     * @return User|null
     * @throws InvalidConfigException
     * @throws BadRequestHttpException
     */
    public function actionSignIn(): ?User
    {
        $model = new SignInForm();
        $model->load(Yii::$app->request->getBodyParams(), '');
        if ($model->validate()) {
            return $model->getUser();
        }
        throw new BadRequestHttpException(array_shift(array_values($model->getErrors())[0]));
    }

    /**
     * @return Response
     * @throws BadRequestHttpException
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionConfirm(): Response
    {
        $token = $this->tokenService->findByCode(Yii::$app->request->get('token'));
        if (!$token) {
            throw new BadRequestHttpException('Неверный токен');
        }
        $token->user->confirmedAt = time();
        $token->user->save();
        $token->delete();
        return $this->redirect('/');
    }

    /**
     * @return User|false
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionResetPassword()
    {
        $model = new PasswordResetForm();
        if ($model->load(Yii::$app->request->getBodyParams(), '') && $model->validate()) {
            /** @var User $user */
            $user = Yii::$app->user->identity;

            if (!$user->validatePassword($model->oldPassword)) {
                throw new BadRequestHttpException('Неверный пароль');
            }
            $user->setPassword($model->newPassword);
            $user->save();
            return $user;
        }
        throw new BadRequestHttpException('Пароли должны совпадать');
    }
}
