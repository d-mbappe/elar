<?php

use yii\db\Migration;

/**
 * Class m210209_084939_add_nullable_fields
 */
class m210209_084939_add_nullable_fields extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%user}}', 'email', $this->string()->unique());
        $this->alterColumn('{{%profile}}', 'patronymic', $this->string());
        $this->addColumn('{{%user}}', 'from', $this->string(64));
        $this->addColumn('{{%user}}', 'uuid', $this->string());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%user}}', 'email', $this->string()->unique()->notNull());
        $this->alterColumn('{{%profile}}', 'patronymic', $this->string()->notNull());
//        $this->dropColumn('{{%user}}', 'from');
//        $this->dropColumn('{{%user}}', 'uuid');
    }
}
