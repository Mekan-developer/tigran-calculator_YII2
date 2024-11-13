<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Stone $model */

$this->title = 'Create Stone';
$this->params['breadcrumbs'][] = ['label' => 'Stones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-100 to-gray-200 py-10">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg">
        
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
            <?= Html::a('Back to Stones', ['index'], ['class' => 'text-blue-600 hover:text-blue-700 font-medium']) ?>
        </div>
        
        <!-- Content -->
        <div class="p-8 space-y-6">
            <p class="text-gray-500 text-sm">
                Complete the form below to add a new stone. Fields marked with an asterisk (*) are required.
            </p>

            <div class="bg-gray-50 border border-gray-200 p-6 rounded-lg space-y-4">
                <!-- Form Start -->
                <?= Html::beginForm(['stone/create'], 'post') ?>
                
                <!-- Material Field -->
                <div class="mb-4">
                    <label for="material" class="block text-sm font-medium text-gray-700 mb-1">Material *</label>
                    <?= Html::activeTextInput($model, 'material', [
                        'id' => 'material',
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                        'required' => true,
                    ]) ?>
                </div>
                
                <!-- Cut Field -->
                <div class="mb-4">
                    <label for="cut" class="block text-sm font-medium text-gray-700 mb-1">Cut *</label>
                    <?= Html::activeTextInput($model, 'cut', [
                        'id' => 'cut',
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                        'required' => true,
                    ]) ?>
                </div>
                
                <!-- Diameter Field -->
                <div class="mb-4">
                    <label for="diameter" class="block text-sm font-medium text-gray-700 mb-1">Diameter (mm)</label>
                    <?= Html::activeInput('number', $model, 'diameter', [
                        'id' => 'diameter',
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                    ]) ?>
                </div>
                
                <!-- Height Field -->
                <div class="mb-4">
                    <label for="height" class="block text-sm font-medium text-gray-700 mb-1">Height (mm)</label>
                    <?= Html::activeInput('number', $model, 'height', [
                        'id' => 'height',
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                    ]) ?>
                </div>

                <!-- Footer with Save Button -->
                <div class="flex justify-end">
                    <?= Html::a('Cancel', ['index'], [
                        'class' => 'mr-3 px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition',
                    ]) ?>
                    <?= Html::submitButton('Create Stone', [
                        'class' => 'px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition',
                    ]) ?>
                </div>

                <!-- Form End -->
                <?= Html::endForm() ?>
            </div>
        </div>
    </div>
</div>
