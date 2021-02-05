<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "profile".
 *
 * @property int    $id
 * @property int    $userId
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property string $phone
 * @property string $birthdate
 * @property string $location
 * @property string $photo
 *
 * @property User   $user
 */
class Profile extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName(): string
    {
        return 'profile';
    }

    /**
     * @inheritdoc
     */
    public function fields(): array
    {
        return ['name', 'surname', 'patronymic', 'phone', 'birthdate', 'location', 'photo'];
    }

    /**
     * {@inheritdoc}
     */
    public function rules(): array
    {
        return [
            [['userId', 'name', 'surname', 'patronymic'], 'required'],
            [['userId'], 'integer'],
            [['birthdate'], 'safe'],
            [['location'], 'string'],
            [['name', 'surname', 'patronymic', 'phone', 'photo'], 'string', 'max' => 255],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['userId' => 'id']],
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
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'birthdate' => 'Дата рождения',
            'location' => 'Место проживания',
            'photo' => 'Фотография',
        ];
    }

    /**
     * Gets query for User.
     *
     * @return ActiveQuery
     */
    public function getUser(): ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'userId']);
    }
}
