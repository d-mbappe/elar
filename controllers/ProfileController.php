<?php


namespace app\controllers;


use app\controllers\basic\BasicApiController;
use app\helpers\DateHelper;
use app\helpers\FileHelper;
use app\models\Profile;
use Yii;
use yii\base\InvalidConfigException;
use yii\base\UserException;

class ProfileController extends BasicApiController
{
    /**
     * @return array
     */
    public function actions(): array
    {
        $actions = parent::actions();
        unset($actions['create'], $actions['view'], $actions['delete'], );
        return [];
    }

    /**
     * @var string
     */
    public $modelClass = Profile::class;

    /**
     * @return Profile|null
     */
    public function actionIndex(): ?Profile
    {
        return $this->getProfile();
    }

    /**
     * @throws UserException
     * @throws InvalidConfigException
     */
    public function actionUpdate(): ?Profile
    {
        $model = $this->getProfile();
        $model->load(Yii::$app->getRequest()->getBodyParams(), '');
        $model->birthdate = DateHelper::toSqlFormat(strtotime($model->birthdate));
        $model->photo = FileHelper::saveFileFromBase64(Yii::$app->getRequest()->getBodyParam('photo'), 'profile');
        if ($model->save() === false) {
            throw new UserException(json_encode($model->errors));
        }
        $model->birthdate = DateHelper::toUserFormat(strtotime($model->birthdate));
        return $model;
    }

    /**
     * @return Profile|null
     */
    public function getProfile(): ?Profile
    {
        return Profile::findOne(['userId' => Yii::$app->user->id]);
    }
}