<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\ClientData $model */

$this->title = 'Добавить данные клиента';
?>

<div class="client-data-form p-6 bg-gray-50">

    <h1 class="text-2xl font-bold text-gray-800 mb-6"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'space-y-6 bg-white p-8 rounded-lg shadow-lg']
    ]); ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- FIO Field -->
        <div>
            <?= $form->field($model, 'fio')->textInput([
                'maxlength' => true,
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Phone Field -->
        <div>
            <?= $form->field($model, 'phone')->textInput([
                'maxlength' => true,
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Product Type Field -->
        <div>
            <?= $form->field($model, 'product_type')->textInput([
                'maxlength' => true,
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Calculation Date Field -->
        <div>
            <?= $form->field($model, 'calculation_date')->input('date', [
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Manager Field -->
        <div>
            <?= $form->field($model, 'manager')->textInput([
                'maxlength' => true,
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>
    </div>

    <div class="flex justify-end">
        <?= Html::submitButton('Далее', [
            'class' => 'px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
