<?php

use app\models\User;
use yii\db\Migration;

/**
 * Class m210210_131955_create_admin_profile
 */
class m210210_131955_create_admin_profile extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $admin = User::findByUsername('admin@elar.ru');
        $this->insert('{{%profile}}', [
            'userId' => $admin->id,
            'name' => 'Администратор',
            'surname' => 'Сайта',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $admin = User::findByUsername('admin@elar.ru');
        $this->delete('{{%profile}}', ['userId'=>$admin->id]);
    }
}
