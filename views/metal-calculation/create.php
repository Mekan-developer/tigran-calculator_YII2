<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\MetalCalculation $model */

$this->title = 'Добавить данные металла';
?>

<div class="metal-calculation-form p-6 bg-gray-50">

    <h1 class="text-2xl font-bold text-gray-800 mb-6"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'options' => ['class' => 'space-y-6 bg-white p-8 rounded-lg shadow-lg']
    ]); ?>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Profile Field -->
        <div>
            <?= $form->field($model, 'profile')->textInput([
                'maxlength' => true,
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Height Field -->
        <div>
            <?= $form->field($model, 'height')->textInput([
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Width Field -->
        <div>
            <?= $form->field($model, 'width')->textInput([
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Ring Size Field -->
        <div>
            <?= $form->field($model, 'ring_size')->textInput([
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Metal Field -->
        <div>
            <?= $form->field($model, 'metal')->textInput([
                'maxlength' => true,
                'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
            ]) ?>
        </div>

        <!-- Tolerance Field -->
        <div>
            <?= $form->field($model, 'tolerance')->textInput([
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
