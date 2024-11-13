<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%numbers}}`.
 */
class m241112_073351_create_numbers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%numbers}}', [
            'id' => $this->primaryKey(),
            'a' => $this->integer()->notNull(),
            'b' => $this->integer()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%numbers}}');
    }
}
