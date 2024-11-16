<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%stones_calculator}}`.
 */
class m241115_054006_create_stone_calculation_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%stone_calculation}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull()->comment('Клиент'),
            'stone_id' => $this->integer()->notNull()->comment('Камень'),
            'cost_per_unit' => $this->decimal(10, 2)->notNull()->comment('Стоимость за 1 шт'),
            'max_possible' => $this->integer()->notNull()->comment('Возможный максимум'),
            'quantity' => $this->integer()->notNull()->comment('Кол-во'),
            'setting_cost' => $this->decimal(10, 2)->notNull()->comment('Стоимость закрепки за 1 шт'),
        ]);

        $this->addForeignKey(
            'fk-stone_calculation-client_id',
            '{{%stone_calculation}}',
            'client_id',
            '{{%client_data}}',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-stone_calculation-stone_id',
            '{{%stone_calculation}}',
            'stone_id',
            '{{%stones}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-stone_calculation-stone_id', '{{%stone_calculation}}');
        $this->dropForeignKey('fk-stone_calculation-client_id', '{{%stone_calculation}}');
        
        $this->dropTable('{{%stone_calculation}}');
    }
}
