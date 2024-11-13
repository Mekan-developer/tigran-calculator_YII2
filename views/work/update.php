<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var yii\widgets\ActiveForm $form */
/** @var app\models\Work $model */

$this->title = 'Обновить работу';
$this->params['breadcrumbs'][] = ['label' => 'Работы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>

<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12 px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-4xl bg-white rounded-lg shadow-xl overflow-hidden">
        
        <!-- Header Section -->
        <div class="px-6 py-4 bg-blue-600 text-white border-b border-blue-700">
            <h1 class="text-3xl font-bold"><?= Html::encode($this->title) ?></h1>
        </div>

        <!-- Breadcrumbs Section -->
        <nav class="px-6 py-4">
            <ol class="inline-flex items-center space-x-1 text-sm text-gray-600">
                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['work/index']) ?>" class="text-blue-600 hover:text-blue-800">Работы</a>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="text-gray-500 mx-2">/</span>
                        <a href="<?= Yii::$app->urlManager->createUrl(['work/view', 'id' => $model->id]) ?>" class="text-blue-600 hover:text-blue-800">Работа #<?= Html::encode($model->id) ?></a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <span class="text-gray-500 mx-2">/</span>
                        <span class="text-gray-500">Обновление</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Form Section -->
        <div class="px-6 py-8">
            <p class="text-gray-600 text-sm mb-6">
                Обновите данные о работе ниже. Поля, отмеченные звездочкой (*), обязательны для заполнения.
            </p>

            <!-- Form Container -->
            <div class="bg-gray-50 border border-gray-200 rounded-lg p-6 shadow-md">
                <?php $form = ActiveForm::begin(); ?>
                
                <!-- Work Name -->
                <div class="flex flex-col mb-4">
                    <?= $form->field($model, 'work_name')->textInput([
                        'class' => 'mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm',
                        'placeholder' => 'Введите название работы'
                    ]) ?>
                </div>

                <!-- Submit Button -->
                <div class="pt-4">
                    <?= Html::submitButton('Обновить работу', [
                        'class' => 'w-full px-6 py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500'
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
