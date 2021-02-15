<?php


namespace app\controllers;


use app\models\forms\SignUpForm;
use app\models\User;
use Yii;
use yii\helpers\Url;
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
            'redirect_uri'  => Url::base(true).'/api/vk/auth',
            'response_type' => 'code'
        ];
        return $url . '?' . urldecode(http_build_query($params));
    }

    /**
     * @param string $code
     * @return string
     */
    public function actionAuth(string $code)
    {
        $params = [
            'client_id' => Yii::$app->params['VKClientId'],
            'client_secret' => Yii::$app->params['VKPrivateKey'],
            'code' => $_GET['code'],
            'redirect_uri' => Url::base(true).'/api/vk/auth'
        ];

        $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);
        if (isset($token['access_token'])) {
            $params = [
                'uids'         => $token['user_id'],
                'fields'       => 'bdate,photo_big',
                'access_token' => $token['access_token'],
                'v' => 5.126
            ];

            $userInfo = json_decode(file_get_contents('https://api.vk.com/method/users.get?' . urldecode(http_build_query($params))), true)['response'][0];
            if (isset($userInfo['id'])) {
                if (!$user = User::findOne(['from' => User::FROM_VK, 'uuid' => $userInfo['id']])) {
                    $user = new SignUpForm();
                    $user->name = $userInfo['first_name'];
                    $user->surname = $userInfo['last_name'];
                    $user->birthdate = $userInfo['bdate'];
                    $user->from = User::FROM_VK;
                    $user->uuid = $userInfo['id'];
                    $user->register();
                }
                $cookies = Yii::$app->response->cookies;

                $cookies->add(new \yii\web\Cookie([
                    'name' => 'tmp_access_token',
                    'value' => $user->authKey,
                ]));
                return $this->redirect('/');
            }
            return false;
        }
    }
}