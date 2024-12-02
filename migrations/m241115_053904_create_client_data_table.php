<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%client_data}}`.
 */
class m241115_053904_create_client_data_table extends Migration
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
            'user_id' => $this->integer()->notNull()->comment('Менеджер'),
        ]);

        // Add an index on the `user_id` column for better query performance
        $this->createIndex(
            'idx-client_data-user_id',
            '{{%client_data}}',
            'user_id'
        );

        // Add a foreign key for `user_id` to the `users` table
        $this->addForeignKey(
            'fk-client_data-user_id',
            '{{%client_data}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE' // Ensure CASCADE behavior is desired; otherwise, change it to SET NULL or RESTRICT
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop the foreign key
        $this->dropForeignKey('fk-client_data-user_id', '{{%client_data}}');

        // Drop the index
        $this->dropIndex('idx-client_data-user_id', '{{%client_data}}');

        // Drop the table
        $this->dropTable('{{%client_data}}');
    }
}

