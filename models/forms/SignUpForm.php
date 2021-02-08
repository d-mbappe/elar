<?php

namespace app\models\forms;


use app\models\Profile;
use app\models\User;
use yii\base\Exception;
use yii\base\UserException;

class SignUpForm extends User
{
    /**
     * @return string
     */
    public static function tableName(): string
    {
        return 'user';
    }

    /**
     * @var string
     */
    public $passwordRepeat;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $patronymic;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $birthdate;

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['email'], 'email'],
            [['email'], 'unique'],
            [['email', 'password', 'passwordRepeat', 'name', 'surname', 'patronymic'], 'required'],
            [['password', 'passwordRepeat', 'name', 'surname', 'patronymic', 'phone'], 'string', 'max' => 255],
            [['password'], 'string', 'min'=> 6, 'max' => 255],
            [['birthdate'], 'date', 'format' => 'php:d.m.Y'],
            ['password', 'compare', 'compareAttribute' => 'passwordRepeat', 'message' => 'Пароли должны совпадать'],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
        ];
    }

    /**
     * @return bool
     * @throws UserException
     * @throws Exception
     */
    public function register(): bool
    {
        if (!$this->validate()) {
            throw new UserException(json_encode($this->errors));
        } else {
            $this->generateAccessToken(86400);
            $this->generateAuthKey();
            $this->setPassword($this->password);
            if (!$this->save(false)) {
                return false;
            }

            $profileModel = new Profile();
            $profileModel->load([
                'userId' => $this->id,
                'name' => $this->name,
                'surname' => $this->surname,
                'patronymic' => $this->patronymic,
                'phone' => $this->phone,
                'birthdate' => date('Y-m-d', strtotime($this->birthdate))
            ], '');

            if (!$profileModel->save()) {
                return false;
            }

            return true;
        }
    }
}
