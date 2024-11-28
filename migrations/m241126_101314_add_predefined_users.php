<?php

use app\models\User\UserRecord;
use yii\db\Migration;

/**
 * Class m241126_101314_add_predefined_users
 */
class m241126_101314_add_predefined_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        foreach(['admin' => '1','manager' => '1'] as $username => $password){
            $user = new UserRecord();
            $user->attributes = compact('username', 'password');
            $user->save();

        }
    }

    /**
     * {@inheritdoc} 
     */
    public function safeDown()
    {
        $this->delete('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241126_101314_add_predefined_users cannot be reverted.\n";

        return false;
    }
    */
}
