<?php


namespace app\services;


use app\models\Token;
use Yii;
use yii\base\Exception;

class TokenService
{
    /**
     * @param int $userId
     * @return Token|null
     * @throws Exception
     */
    public function generateEmailConfirmationToken(int $userId): ?Token
    {
        $token = new Token();
        $token->load([
            'userId' => $userId,
            'type' => Token::TYPE_EMAIL_CONFIRMATION,
            'code' => $this->generateTokenCode()
        ], '');
        return $token;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function generateTokenCode(): string
    {
        return Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * @param string $code
     * @return Token|null
     */
    public function findByCode(string $code): ?Token
    {
        return Token::findOne(['code' => $code]);
    }
}