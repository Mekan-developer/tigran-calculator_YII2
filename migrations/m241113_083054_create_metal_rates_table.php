<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%metal_rates}}`.
 */
class m241113_083054_create_metal_rates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%metal_rates}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull()->comment('Дата'), // Дата
            'metal' => $this->string(255)->notNull()->comment('Металл'), // Металл
            'rate' => $this->decimal(10, 2)->notNull()->comment('Курс, руб'), // Курс, руб
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%metal_rates}}');
    }
}
