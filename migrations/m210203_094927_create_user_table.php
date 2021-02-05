<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m210203_094927_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey()->unsigned(),
            'email' => $this->string()->unique()->notNull(),
            'password' => $this->string()->notNull(),
            'authKey' => $this->string(),
            'accessToken' => $this->string(),
            'confirmedAt' => $this->integer()->unsigned(),
            'status' => $this->tinyInteger()->defaultValue(1)->notNull(),
            'createdAt' => $this->integer()->unsigned()->notNull(),
            'updatedAt' => $this->integer()->unsigned()->notNull()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}
