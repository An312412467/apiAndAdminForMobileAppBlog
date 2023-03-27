<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%userData}}`.
 */
class m230327_141125_create_userData_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%userData}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)->notNull(),
            'email' => $this->string(50)->notNull(),
            'password' => $this->string(50)->notNull(),
            'role' => $this->string(5)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%userData}}');
    }
}
