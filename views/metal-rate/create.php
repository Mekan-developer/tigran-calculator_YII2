<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MetalRate $model */

$this->title = 'Создать курс металла';
$this->params['breadcrumbs'][] = ['label' => 'Курсы металлов', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-100 to-gray-200 py-10">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg">
        
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
            <?= Html::a('Вернуться к списку', ['index'], ['class' => 'text-blue-600 hover:text-blue-700 font-medium']) ?>
        </div>
        
        <!-- Content -->
        <div class="p-8 space-y-6">
            <p class="text-gray-500 text-sm">
                Заполните форму ниже, чтобы добавить новый курс металла. Поля, отмеченные звездочкой (*), обязательны для заполнения.
            </p>

            <div class="bg-gray-50 border border-gray-200 p-6 rounded-lg space-y-4">
                <?php $form = ActiveForm::begin(); ?>

                <!-- Date Field -->
                <div class="mb-4">
                    <?= $form->field($model, 'date')->input('date', [
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                        'required' => true,
                    ])->label('Дата *', ['class' => 'block text-sm font-medium text-gray-700 mb-1']) ?>
                </div>

                <!-- Metal Field -->
                <div class="mb-4">
                    <?= $form->field($model, 'metal')->textInput([
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                        'placeholder' => 'Введите название металла',
                        'required' => true,
                    ])->label('Металл *', ['class' => 'block text-sm font-medium text-gray-700 mb-1']) ?>
                </div>

                <!-- Rate Field -->
                <div class="mb-4">
                    <?= $form->field($model, 'rate')->textInput([
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                        'placeholder' => 'Введите курс в рублях',
                        'required' => true,
                    ])->label('Курс, руб *', ['class' => 'block text-sm font-medium text-gray-700 mb-1']) ?>
                </div>

                <!-- Footer with Save and Cancel Buttons -->
                <div class="flex justify-end">
                    <?= Html::a('Отмена', ['index'], [
                        'class' => 'mr-3 px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition',
                    ]) ?>
                    <?= Html::submitButton('Сохранить курс', [
                        'class' => 'px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition',
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
