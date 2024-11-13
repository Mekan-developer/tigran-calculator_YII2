<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work}}`.
 */
class m241113_065619_create_work_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work}}', [
            'id' => $this->primaryKey(),  // ID column as primary key
            'work_name' => $this->string()->notNull(),  // Job Name (Работа)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%work}}');
    }
}
