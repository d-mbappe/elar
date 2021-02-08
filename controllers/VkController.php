<?php


namespace app\controllers;


use Yii;
use yii\rest\Controller;

class VkController extends Controller
{
    /**
     * @return string
     */
    public function actionGetAuthLink(): string
    {
        $url = 'http://oauth.vk.com/authorize';
        $params = [
            'client_id'     => Yii::$app->params['VKClientId'],
            'redirect_uri'  => Yii::$app->params['VKPrivateKey'],
            'response_type' => 'code'
        ];
        return $url . '?' . urldecode(http_build_query($params));
    }
}