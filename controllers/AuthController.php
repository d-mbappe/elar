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
use yii\base\UserException;
use yii\db\StaleObjectException;
use yii\rest\Controller;

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
            'confirm' => ['GET'],
        ];
    }

    /**
     * @return SignUpForm
     * @throws UserException
     * @throws Exception
     * @throws InvalidConfigException
     */
    public function actionSignUp(): SignUpForm
    {
        $model = new SignUpForm();
        $model->load(Yii::$app->request->getBodyParams());
        if ($model->register()) {
            $token = $this->tokenService->generateEmailConfirmationToken($model->id);
            $token->save();
            MailSendHelper::sendEmailConfirmationMessage($model->email, $token->code);
            return $model;
        }
        throw new UserException('Неизвестная ошибка');
    }

    /**
     * @return User|null
     * @throws InvalidConfigException
     * @throws UserException
     */
    public function actionSignIn(): ?User
    {
        $model = new SignInForm();
        $model->load(Yii::$app->request->getBodyParams());
        if ($model->validate()) {
            return $model->getUser();
        }
        throw new UserException(json_encode($model->errors));
    }

    /**
     * @return User
     * @throws UserException
     * @throws StaleObjectException
     * @throws Throwable
     */
    public function actionConfirm(): User
    {
        $token = $this->tokenService->findByCode(Yii::$app->request->get('code'));
        if (!$token) {
            throw new UserException('Неверный токен');
        }
        $token->user->confirmedAt = time();
        $token->user->save();
        $token->delete();
        return $token->user;
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
            $user->setPassword($model->newPassword);
            $user->save();
            return $user;
        }
        return false;
    }
}