<?php

namespace app\models\forms;

use yii\base\Model;

class PasswordResetForm extends Model
{
    /**
     * @var string
     */
    public $oldPassword;
    /**
     * @var string
     */
    public $newPassword;
    /**
     * @var string
     */
    public $newPasswordRepeat;

    /**
     * @return array the validation rules.
     */
    public function rules(): array
    {
        return [
            [['oldPassword', 'newPassword', 'newPasswordRepeat'], 'required'],
            [['oldPassword', 'newPassword', 'newPasswordRepeat'], 'string', 'max' => 256],
            ['newPassword', 'compare', 'compareAttribute' => 'newPasswordRepeat', 'message' => 'Пароли должны совпадать'],
        ];
    }
}
