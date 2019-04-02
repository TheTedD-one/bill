<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%requisites}}`.
 */
class m190206_073332_create_requisites_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%requisites}}', [
            'id' => $this->primaryKey(),
            'is_deleted' => $this->boolean()->notNull()->defaultValue(0),
            'created_date' => $this->dateTime()->notNull(),
            'modified_date' => $this->dateTime()->notNull(),
            'name' => $this->string()->notNull(),
            'bin' => $this->string()->notNull(),
            'bank' => $this->string()->notNull(),
            'iik' => $this->string()->notNull(),
            'bik' => $this->string()->notNull(),
            'address' => $this->string()->notNull(),
            'isMe' => $this->boolean()->notNull()->defaultValue(0),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%requisites}}');
    }
}
