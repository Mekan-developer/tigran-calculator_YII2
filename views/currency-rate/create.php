<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CurrencyRate $model */

$this->title = 'Создать курс валюты';
$this->params['breadcrumbs'][] = ['label' => 'Курсы валют', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-100 to-gray-200 py-10">
    <div class="w-full max-w-3xl bg-white rounded-sm shadow-lg">
        
        <!-- Заголовок -->
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
            <?= Html::a('Вернуться к списку', ['index'], ['class' => 'text-blue-600 hover:text-blue-700 font-medium']) ?>
        </div>
        
        <!-- Контент -->
        <div class="p-8 space-y-6">
            <p class="text-gray-500 text-sm">
                Заполните форму ниже, чтобы добавить новый курс валюты. Поля, отмеченные звездочкой (*), обязательны для заполнения.
            </p>

            <div class="bg-gray-50 border border-gray-200 p-6 rounded-sm space-y-4">
                <?php $form = ActiveForm::begin(); ?>

                <!-- Поле Дата -->
                <div class="mb-4">
                    <?= $form->field($model, 'date')->input('date', [
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-sm shadow-sm focus:ring-blue-500 focus:border-blue-500',
                        'required' => true,
                    ])->label('Дата *', ['class' => 'block text-sm font-medium text-gray-700 mb-1']) ?>
                </div>

                <!-- Поле Валюта -->
                <div class="mb-4">
                    <?= $form->field($model, 'currency')->textInput([
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-sm shadow-sm focus:ring-blue-500 focus:border-blue-500',
                        'placeholder' => 'Введите название валюты (например, USD, EUR)',
                        'required' => true,
                    ])->label('Валюта *', ['class' => 'block text-sm font-medium text-gray-700 mb-1']) ?>
                </div>

                <!-- Поле Курс -->
                <div class="mb-4">
                    <?= $form->field($model, 'rate')->textInput([
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-sm shadow-sm focus:ring-blue-500 focus:border-blue-500',
                        'placeholder' => 'Введите курс валюты',
                        'required' => true,
                    ])->label('Курс *', ['class' => 'block text-sm font-medium text-gray-700 mb-1']) ?>
                </div>

                <!-- Нижний колонтитул с кнопками -->
                <div class="flex justify-end">
                    <?= Html::a('Отмена', ['index'], [
                        'class' => 'mr-3 px-4 py-2 rounded-sm border border-gray-300 text-gray-600 hover:bg-gray-100 transition',
                    ]) ?>
                    <?= Html::submitButton('Сохранить курс', [
                        'class' => 'px-4 py-2 bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition',
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
