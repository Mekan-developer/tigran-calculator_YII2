<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StoneCalculation $model */

$this->title = 'Добавить данные камней';
?>

<div class="stone-calculation-form p-6 bg-gray-50">

    <h1 class="text-2xl font-bold text-gray-800 mb-6"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'space-y-6 bg-white p-8 rounded-lg shadow-lg']
    ]); ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Stone Field -->
        <div>
            <?= $form->field($model, 'stone')->textInput([
                'maxlength' => true,
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Cost Per Unit Field -->
        <div>
            <?= $form->field($model, 'cost_per_unit')->textInput([
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Max Possible Field -->
        <div>
            <?= $form->field($model, 'max_possible')->textInput([
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Quantity Field -->
        <div>
            <?= $form->field($model, 'quantity')->textInput([
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Setting Cost Field -->
        <div>
            <?= $form->field($model, 'setting_cost')->textInput([
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>
    </div>

    <!-- Submit Button -->
    <div class="flex justify-end">
        <?= Html::submitButton('Далее', [
            'class' => 'px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition',
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
