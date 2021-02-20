<?php

namespace app\models\forms;


use app\models\Profile;
use app\models\User;
use Yii;
use yii\base\Exception;
use yii\base\UserException;
use yii\web\BadRequestHttpException;

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
     * @var string
     */
    public $photo;

    const SCENARIO_FROM_SITE = 'from_site';
    const SCENARIO_FROM_VK = 'from_vk';
    const SCENARIO_FROM_OK = 'from_ok';

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            [['email'], 'email'],
            [['email'], 'unique', 'message' => 'Пользователь с таким email уже существует'],
            [['name', 'surname'], 'required'],
            [['email', 'password', 'passwordRepeat'], 'required', 'on' => self::SCENARIO_FROM_SITE],
            [['password', 'passwordRepeat', 'name', 'surname', 'patronymic', 'phone', 'photo', 'from'], 'string', 'max' => 255],
            [['password'], 'string', 'min'=> 6, 'max' => 255],
            [['birthdate'], 'date', 'format' => 'php:Y-m-d', 'on' => self::SCENARIO_FROM_SITE],
            [['birthdate'], 'date', 'format' => 'php:Y-m-d', 'on' => self::SCENARIO_FROM_OK],
            [['birthdate'], 'date', 'format' => 'php:d.n.Y', 'on' => self::SCENARIO_FROM_VK],
            ['password', 'compare', 'compareAttribute' => 'passwordRepeat', 'message' => 'Пароли должны совпадать', 'on' => self::SCENARIO_FROM_SITE],
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
            throw new BadRequestHttpException(array_shift(array_values($this->getErrors())[0]));
        } else {
            $this->generateAccessToken(86400);
            $this->generateAuthKey();
            if ($this->getScenario() === self::SCENARIO_FROM_SITE) {
                $this->setPassword($this->password);
            } else {
                $this->setPassword(Yii::$app->security->generateRandomString());
            }
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
                'photo' => $this->photo,
                'birthdate' => date('Y-m-d', strtotime($this->birthdate))
            ], '');

            if (!$profileModel->save()) {
                throw new BadRequestHttpException(array_shift(array_values($profileModel->getErrors())[0]));
            }

            return true;
        }
    }
}
