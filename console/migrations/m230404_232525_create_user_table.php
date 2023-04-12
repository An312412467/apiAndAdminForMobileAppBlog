<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m230404_232525_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user}}', [
            'userId' => $this->primaryKey(),
            'name' => $this->string(50)->notNull()->unique(),
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
        $this->dropTable('{{%user}}');
    }
}
