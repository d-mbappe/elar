<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m210204_111933_create_admin_user
 */
class m210204_111933_create_admin_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert('user', [
            'email' => 'admin@elar.ru',
            'password' => '$2y$13$NOgbv0eU27dbF3PsJqNjFOxofvbU0NA4Gd9XDUc0N6DJeeeQx7.TK', // superpass
            'authKey' => 'hlpP-x3B6lNc_t3Lm9PAG8Wano_WYUOh',
            'accessToken' => 'JaJvZdLJijuQvBBO1weKP0mTXtuXS8eD_1612521017',
            'confirmedAt' => time(),
            'status' => 10,
            'createdAt' => time(),
            'updatedAt' => time(),
        ]);
        $user = User::findOne(['email' => 'admin@elar.ru']);
        $auth = Yii::$app->authManager;

        $auth->removeAll();

        $admin = $auth->createRole('admin');

        $auth->add($admin);

        $auth->assign($admin, $user->id);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

    }
}
