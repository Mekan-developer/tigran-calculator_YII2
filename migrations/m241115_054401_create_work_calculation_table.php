<?php

use yii\db\Migration;

/**
 * Class m241115_054401_create_work_calculator_tabl
 */
class m241115_054401_create_work_calculation_table  extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_calculation}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull()->comment('Клиент'),
            'work_type' => $this->string()->notNull()->comment('Тип работ'),
            'cost' => $this->decimal(10, 2)->notNull()->comment('Стоимость'),
        ]);

        $this->addForeignKey(
            'fk-work_calculation-client_id',
            '{{%work_calculation}}',
            'client_id',
            '{{%client_data}}',
            'id',
            'CASCADE'
        );
    }


    public function safeDown()
    {
        $this->dropForeignKey('fk-work_calculation-client_id', '{{%work_calculation}}');
        $this->dropTable('{{%work_calculation}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241115_054401_create_work_calculator_tabl cannot be reverted.\n";

        return false;
    }
    */
}
