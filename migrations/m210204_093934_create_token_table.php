<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%token}}`.
 */
class m210204_093934_create_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%token}}', [
            'id' => $this->primaryKey()->unsigned(),
            'userId' => $this->integer()->unsigned()->notNull(),
            'code' => $this->string()->notNull(),
            'type' => $this->tinyInteger()->notNull(),
            'createdAt' => $this->integer()->unsigned()->notNull()
        ]);
        $this->addForeignKey('user_token', '{{%token}}', 'userId', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('user_token', '{{%token}}');
        $this->dropTable('{{%token}}');
    }
}
