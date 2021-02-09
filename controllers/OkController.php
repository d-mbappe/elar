<?php


namespace app\controllers;


use Yii;
use yii\rest\Controller;

class OkController extends Controller
{
    /**
     * @return string
     */
    public function actionGetAuthLink(): string
    {
        $url = 'http://www.odnoklassniki.ru/oauth/authorize';
        $params = [
            'client_id'     => Yii::$app->params['OKClientId'],
            'redirect_uri'  => Yii::$app->request->getBaseUrl(),'/ok/auth',
            'response_type' => 'code'
        ];
        return $url . '?' . urldecode(http_build_query($params));
    }
}