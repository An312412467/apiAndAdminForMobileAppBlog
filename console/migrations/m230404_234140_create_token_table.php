<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%token}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230404_234140_create_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%token}}', [
            'tokenId' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'acessToken' => $this->string()->notNull()->unique(),
        ]);

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-token-userId}}',
            '{{%token}}',
            'userId',
            '{{%user}}',
            'userId',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%token}}');
    }
}
