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

            'my_requisites_id' => $this->integer()->notNull(),
            'customer_requisites_id' => $this->integer()->notNull(),

            'sender_requisites_id' => $this->integer()->notNull(),
            'recipient_requisites_id' => $this->integer()->notNull(),

            'contract_type' => $this->string(),
            'payment_type' => $this->string(),

            'delivery_point' => $this->string(),
            'delivery_type' => $this->string(),
            'delivery_document' => $this->string(),
            'transport_document' => $this->string(),
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
