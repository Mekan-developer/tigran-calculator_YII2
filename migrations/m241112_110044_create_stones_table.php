<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stones}}`.
 */
class m241112_110044_create_stones_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%stones}}', [
            'id' => $this->primaryKey(),
            'material' => $this->string()->notNull(),
            'cut' => $this->string()->notNull(),
            'diameter' => $this->float()->notNull(),
            'height' => $this->float()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%stones}}');
    }
}
