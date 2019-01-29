<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%position}}`.
 */
class m190129_121650_create_position_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%position}}', [
            'id' => $this->primaryKey(),
            'is_deleted' => $this->boolean()->notNull()->defaultValue(0),
            'created_date' => $this->dateTime()->notNull(),
            'modified_date' => $this->dateTime()->notNull(),
            'bill_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'unit' => $this->integer()->notNull(),
            'quantity' => $this->double()->notNull(),
            'price' => $this->double()->notNull(),
            'tax_rate' => $this->double()->notNull(),
            'tax_sum' => $this->double()->notNull(),
            'total_price' => $this->double()->notNull(),
            'excise_rate' => $this->double()->notNull(),
            'excise_sum' => $this->double()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%position}}');
    }
}
