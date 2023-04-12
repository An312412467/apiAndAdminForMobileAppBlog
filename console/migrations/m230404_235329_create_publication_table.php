<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%publication}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m230404_235329_create_publication_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%publication}}', [
            'publicationId' => $this->primaryKey(),
            'userId' => $this->integer()->notNull(),
            'text' => $this->text()->notNull(),
        ]);

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-publication-userId}}',
            '{{%publication}}',
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
        $this->dropTable('{{%publication}}');
    }
}
