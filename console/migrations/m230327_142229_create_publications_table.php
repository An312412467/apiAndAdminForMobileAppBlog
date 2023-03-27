<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%publications}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%userData}}`
 */
class m230327_142229_create_publications_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%publications}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'publication' => $this->string()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-publications-user_id}}',
            '{{%publications}}',
            'user_id'
        );

        // add foreign key for table `{{%userData}}`
        $this->addForeignKey(
            '{{%fk-publications-user_id}}',
            '{{%publications}}',
            'user_id',
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
        // drops foreign key for table `{{%userData}}`
        $this->dropForeignKey(
            '{{%fk-publications-user_id}}',
            '{{%publications}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-publications-user_id}}',
            '{{%publications}}'
        );

        $this->dropTable('{{%publications}}');
    }
}
