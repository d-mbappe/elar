<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property int            $id
 * @property string         $email
 * @property string         $password
 * @property string         $authKey
 * @property string         $accessToken
 * @property int            $confirmedAt
 * @property int            $status
 * @property int            $createdAt
 * @property int            $updatedAt
 * @property string         $from
 * @property string         $uuid
 *
 * @property Profile        $profile
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;

    const FROM_SITE = 'from_site';
    const FROM_VK = 'from_vk';
    const FROM_OK = 'from_ok';

    /**
     * @inheritdoc
     */
    public function fields(): array
    {
        return ['email', 'status', 'accessToken', 'from'];
    }

    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'createdAt',
                'updatedAtAttribute' => 'updatedAt'
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules(): array
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_ACTIVE, self::STATUS_DELETED]],
            ['from', 'default', 'value' => self::FROM_SITE],
            ['from', 'in', 'range' => [self::FROM_SITE, self::FROM_OK, self::FROM_VK]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @param $expireInSeconds
     * @throws Exception
     */
    public function generateAccessToken($expireInSeconds)
    {
        $this->accessToken = Yii::$app->security->generateRandomString() . '_' . (time() + $expireInSeconds);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return User|IdentityInterface|null
     */
    public static function findByUsername(string $username)
    {
        return static::findOne(['email' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey(): string
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey): bool
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * @param string $password
     * @return bool
     */
    public function validatePassword(string $password): bool
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * @param string $password
     * @throws Exception
     */
    public function setPassword(string $password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * @throws Exception
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    /**
     * Gets query for User.
     *
     * @return ActiveQuery
     */
    public function getProfile(): ActiveQuery
    {
        return $this->hasOne(Profile::class, ['user_id' => 'id']);
    }

}
