<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "token".
 *
 * @property int    $id
 * @property int    $userId
 * @property string $code
 * @property int    $type
 * @property int    $createdAt
 *
 * @property User   $user
 */
class Token extends ActiveRecord
{
    const TYPE_EMAIL_CONFIRMATION = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'token';
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['userId', 'code', 'type'], 'required'],
            [['userId', 'type', 'createdAt'], 'integer'],
            [['code'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
        ];
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
                'updatedAtAttribute' => false
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels(): array
    {
        return [
            'id' => 'ID',
            'userId' => 'User ID',
            'code' => 'Code',
            'type' => 'Type',
            'createdAt' => 'Created At',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }
}
