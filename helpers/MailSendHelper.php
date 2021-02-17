<?php


namespace app\helpers;


use Yii;

class MailSendHelper
{
    /**
     * @param string $email
     * @param string $code
     * @return bool
     */
    public static function sendEmailConfirmationMessage(string $email , string $code): bool
    {
        return Yii::$app->mailer->compose()
            ->setFrom('aizosimov@elar.ru')
            ->setTo($email)
            ->setSubject('Активация аккаунта')
            ->setTextBody("Вы зарегистрировали аккаунт на сайте ".
                Yii::$app->request->getHostInfo().
                ". Для активации аккаунта перейдите по ссылке ".
                Yii::$app->request->getHostInfo()."/api/auth/confirm?token=$code ."
            )
            ->send();
    }
}