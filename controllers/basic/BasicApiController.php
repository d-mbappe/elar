<?php


namespace app\controllers\basic;


use yii\filters\auth\HttpBearerAuth;
use yii\rest\ActiveController;

class BasicApiController extends ActiveController
{
    /**
     * @return array
     */
    public function behaviors(): array
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBearerAuth::className(),
        ];
        return $behaviors;
    }
}
