<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%metals_calculator}}`.
 */
class m241115_054355_create_metal_calculation_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('{{%metal_calculation}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull()->comment('Клиент'),
            'profile' => $this->string()->notNull()->comment('Профиль'),
            'height' => $this->decimal(10, 2)->notNull()->comment('Высота'),
            'width' => $this->decimal(10, 2)->notNull()->comment('Ширина'),
            'ring_size' => $this->decimal(10, 2)->notNull()->comment('Размер кольца'),
            'metal' => $this->string()->notNull()->comment('Металл'),
            'tolerance' => $this->decimal(5, 2)->notNull()->comment('Погрешность, %'),
        ]);

        $this->addForeignKey(
            'fk-metal_calculation-client_id',
            '{{%metal_calculation}}',
            'client_id',
            '{{%client_data}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-metal_calculation-client_id', '{{%metal_calculation}}');
        $this->dropTable('{{%metal_calculation}}');
    }
}
