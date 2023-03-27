<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tokens}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230327_141459_create_tokens_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tokens}}', [
            'id' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'acessToken' => $this->string()->notNull()->unique()
        ]);

        // creates index for column `userId`
        $this->createIndex(
            '{{%idx-tokens-userId}}',
            '{{%tokens}}',
            'userId'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-tokens-userId}}',
            '{{%tokens}}',
            'userId',
            '{{%userData}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-tokens-userId}}',
            '{{%tokens}}'
        );

        // drops index for column `userId`
        $this->dropIndex(
            '{{%idx-tokens-userId}}',
            '{{%tokens}}'
        );

        $this->dropTable('{{%tokens}}');
    }
}
