<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/** @var yii\widgets\ActiveForm $form */
/** @var app\models\Work $model */

$this->title = 'Создать Работу';
$this->params['breadcrumbs'][] = ['label' => 'Работы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-100 to-gray-200 py-10">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg">
        
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
            <?= Html::a('Вернуться к работам', ['index'], ['class' => 'text-blue-600 hover:text-blue-700 font-medium']) ?>
        </div>
        
        <!-- Content -->
        <div class="p-8 space-y-6">
            <p class="text-gray-500 text-sm">
                Заполните форму ниже, чтобы добавить новую работу. Поля, отмеченные звездочкой (*), обязательны для заполнения.
            </p>

            <div class="bg-gray-50 border border-gray-200 p-6 rounded-lg space-y-4">
                <?php $form = ActiveForm::begin(); ?>

                <!-- Work Name Field -->
                <div class="mb-4">
                    <?= $form->field($model, 'work_name')->textInput([
                        'class' => 'block w-full p-2.5 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                        'placeholder' => 'Введите название работы',
                        'required' => true,
                    ])->label('Название работы *', ['class' => 'block text-sm font-medium text-gray-700 mb-1']) ?>
                </div>

                <!-- Footer with Save and Cancel Buttons -->
                <div class="flex justify-end">
                    <?= Html::a('Отмена', ['index'], [
                        'class' => 'mr-3 px-4 py-2 rounded-lg border border-gray-300 text-gray-600 hover:bg-gray-100 transition',
                    ]) ?>
                    <?= Html::submitButton('Сохранить работу', [
                        'class' => 'px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition',
                    ]) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
