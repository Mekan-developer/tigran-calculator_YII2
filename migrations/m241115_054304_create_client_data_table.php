<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_data}}`.
 */
class m241115_054304_create_client_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%client_data}}', [
            'id' => $this->primaryKey(),
            'fio' => $this->string()->notNull()->comment('ФИО'),
            'phone' => $this->string()->notNull()->comment('Телефон'),
            'product_type' => $this->string()->notNull()->comment('Тип изделия'),
            'calculation_date' => $this->date()->notNull()->comment('Дата расчёта'),
            'manager' => $this->string()->notNull()->comment('Менеджер'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%client_data}}');
    }
}
