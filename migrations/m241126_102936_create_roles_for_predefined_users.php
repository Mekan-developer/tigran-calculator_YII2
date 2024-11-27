<?php

use app\models\User\UserRecord;
use yii\db\Migration;

/**
 * Class m241126_102936_create_roles_for_predefined_users
 */
class m241126_102936_create_roles_for_predefined_users extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $rbac = Yii::$app->authManager;

        // Create guest role
        $guest = $rbac->createRole('guest');
        $guest->description = 'Гость';
        $rbac->add($guest);

        // Create user role
        // $user = $rbac->createRole('user');
        // $user->description = 'Может использовать пользовательский интерфейс запроса и ничего больше';
        // $rbac->add($user);

        // Create manager role
        $manager = $rbac->createRole('manager');
        $manager->description = 'Может управлять объектами в базе данных, но не для пользователей';
        $rbac->add($manager);

        // Create admin role
        $admin = $rbac->createRole('admin');
        $admin->description = 'Может делать что угодно, включая управление пользователями';
        $rbac->add($admin);

        // Set role hierarchy
        $rbac->addChild($admin, $manager);
        $rbac->addChild($manager, $guest);
        // $rbac->addChild($user, $guest);

        // Assign user role to a specific user
        // $rbac->assign(
        //     $user,
        //     UserRecord::findOne(['username' => 'user'])->id
        // );


         $rbac->assign(
            $manager,
            UserRecord::findOne(['username' => 'manager'])->id
        );

        $rbac->assign(
            $admin,
            UserRecord::findOne(['username' => 'admin'])->id
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
       
        $manager = Yii::$app->authManager;
        $manager->removeAll(); 
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m241126_102936_create_roles_for_predefined_users cannot be reverted.\n";

        return false;
    }
    */
}
