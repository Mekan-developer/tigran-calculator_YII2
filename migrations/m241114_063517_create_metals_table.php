<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%metals}}`.
 */
class m241114_063517_create_metals_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%metals}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull()->comment('Название'), // Metal name
            'density' => $this->decimal(10, 2)->notNull()->comment('Плотность'), // Metal density
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%metals}}');
    }
}
