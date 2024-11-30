<?php

use yii\db\Migration;

/**
 * Class m241128_091311_rbac_migrate
 */
class m241126_091311_rbac_migrate extends Migration
{
     /**
     * @inheritdoc
     */
    public function up()
    {
        // Run the RBAC migration after running the general migrations
        echo "Running RBAC migrations...\n";

        // Programmatically run the RBAC migration
        $result = Yii::$app->runAction('migrate', [
            'migrationPath' => '@yii/rbac/migrations'
        ]);

        if ($result) {
            echo "RBAC migrations completed successfully.\n";
        } else {
            echo "RBAC migrations failed.\n";
        }
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        // Optionally, add logic to revert the migrations if needed.
        echo "Rolling back RBAC migrations...\n";
        Yii::$app->runAction('migrate/down', [
            'migrationPath' => '@yii/rbac/migrations'
        ]);
    }
}
