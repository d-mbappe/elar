<?php


namespace app\controllers;


use app\models\forms\SignUpForm;
use app\models\User;
use Yii;
use yii\helpers\Url;
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
            'redirect_uri'  => Url::base(true).'/api/ok/auth',
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
            'code' => $code,
            'redirect_uri' => Url::base(true).'/api/ok/auth',
            'grant_type' => 'authorization_code',
            'client_id' => Yii::$app->params['OKClientId'],
            'client_secret' => Yii::$app->params['OKPrivateKey']
        ];

        $url = 'http://api.odnoklassniki.ru/oauth/token.do';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url); // url, куда будет отправлен запрос
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, urldecode(http_build_query($params))); // передаём параметры
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($curl);
        curl_close($curl);

        $tokenInfo = json_decode($result, true);
        if (isset($tokenInfo['access_token'])) {
            $public_key = Yii::$app->params['OKPublicKey'];
            $client_secret = Yii::$app->params['OKPrivateKey'];
            $sign = md5("application_key={$public_key}format=jsonmethod=users.getCurrentUser" . md5("{$tokenInfo['access_token']}{$client_secret}"));

            $params = array(
                'method'          => 'users.getCurrentUser',
                'access_token'    => $tokenInfo['access_token'],
                'application_key' => $public_key,
                'format'          => 'json',
                'sig'             => $sign
            );

            $userInfo = json_decode(file_get_contents('http://api.odnoklassniki.ru/fb.do' . '?' . urldecode(http_build_query($params))), true);


            if (isset($userInfo['uid'])) {
                if (!$user = User::findOne(['from' => User::FROM_OK, 'uuid' => $userInfo['uid']])) {
                    $user = new SignUpForm();
                    $user->name = $userInfo['first_name'];
                    $user->surname = $userInfo['last_name'];
                    $user->birthdate = $userInfo['birthday'];
                    $user->from = User::FROM_OK;
                    $user->uuid = $userInfo['uid'];
                    $user->photo = $userInfo['pic_1'];
                    $user->register();
                }
                setcookie('tmp_access_token', $user->accessToken, ['expires' => time()+7200, 'path' => '/', 'secure' => false, 'httponly' => false]);

                return $this->redirect('/account');
            }
            return false;
        }
    }
}