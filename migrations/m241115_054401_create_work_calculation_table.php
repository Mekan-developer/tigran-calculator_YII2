<?php

use yii\db\Migration;

/**
 * Class m241115_054401_create_work_calculation_table
 */
class m241115_054401_create_work_calculation_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create the work_calculation table
        $this->createTable('{{%work_calculation}}', [
            'id' => $this->primaryKey(),
            'client_id' => $this->integer()->notNull()->comment('Клиент'),
            'work_id' => $this->integer()->notNull()->comment('Работа'),
            'cost' => $this->decimal(10, 2)->notNull()->comment('Стоимость'),
        ]);

        // Add foreign key to the client_data table
        $this->addForeignKey(
            'fk-work_calculation-client_id',
            '{{%work_calculation}}',
            'client_id',
            '{{%client_data}}',
            'id',
            'CASCADE'
        );

        // Add foreign key to the work table (corrected here)
        $this->addForeignKey(
            'fk-work_calculation-work_id',
            '{{%work_calculation}}',
            'work_id',
            '{{%work}}', // Reference the correct table
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop foreign keys
        $this->dropForeignKey('fk-work_calculation-client_id', '{{%work_calculation}}');
        $this->dropForeignKey('fk-work_calculation-work_id', '{{%work_calculation}}');
        
        // Drop the table
        $this->dropTable('{{%work_calculation}}');
    }
}
