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
            ->setFrom('noreply@elar.com')
            ->setTo($email)
            ->setSubject('Активация аккаунта')
            ->setTextBody("Вы зарегистрировали аккаунт на сайте ".
                Yii::$app->request->getHostInfo().
                ". Для активации аккаунта перейдите по ссылке ".
                Yii::$app->request->getHostInfo()."/auth/confirm?token=$code ."
            )
            ->send();
    }
}