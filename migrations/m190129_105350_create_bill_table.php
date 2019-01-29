<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bill}}`.
 */
class m190129_105350_create_bill_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bill}}', [
            'id' => $this->primaryKey(),
            'is_deleted' => $this->boolean()->notNull()->defaultValue(0),
            'created_date' => $this->dateTime()->notNull(),
            'modified_date' => $this->dateTime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bill}}');
    }
}
