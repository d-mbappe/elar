<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%profile}}`.
 */
class m210203_095848_create_profile_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%profile}}', [
            'id' => $this->primaryKey()->unsigned(),
            'userId' => $this->integer()->unsigned()->notNull(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'patronymic' => $this->string()->notNull(),
            'phone' => $this->string(),
            'birthdate' => $this->date(),
            'location' => $this->text(),
            'photo' => $this->string()
        ]);
        $this->createIndex('profileUserIndex', '{{%profile}}', 'userId');
        $this->addForeignKey('profileUserFK', '{{%profile}}', 'userId', '{{%user}}', 'id', 'CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('profileUserFK', '{{%profile}}');
        $this->dropIndex('profileUserIndex', '{{%profile}}');
        $this->dropTable('{{%profile}}');
    }
}
