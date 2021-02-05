<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Model;

class SignInForm extends Model
{
    public $email;
    public $password;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['email', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword(string $attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный Email адрес или пароль.');
            }
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser(): ?User
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }
}
