<?php

namespace app\models\forms;

use app\models\User;
use Yii;
use yii\base\Model;

class PasswordResetForm extends Model
{
    public $oldPassword;
    public $newPassword;
    public $newPasswordRepeat;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['orlPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
            [['orlPassword', 'newPassword', 'newPasswordRepeat'], 'string', 'max' => 256],
            ['newPassword', 'compare', 'compareAttribute' => 'newPasswordRepeat', 'message' => 'Пароли должны совпадать'],
        ];
    }
}
