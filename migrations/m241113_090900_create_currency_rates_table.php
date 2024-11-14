<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%currency_rates}}`.
 */
class m241113_090900_create_currency_rates_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%currency_rates}}', [
            'id' => $this->primaryKey(),
            'date' => $this->date()->notNull()->comment('Датa'), // Датe
            'currency' => $this->string(255)->notNull()->comment('Валюта'), // Валюта
            'rate' => $this->decimal(10, 2)->notNull()->comment('Курс, руб'), // Курс, руб
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%currency_rates}}');
    }
}
