<?php
use yii\bootstrap5\Alert;

echo Alert::widget([
    'options' => [
        'class' => 'bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative',
    ],
    'body' => 'This is an alert message!',
]);
?>
