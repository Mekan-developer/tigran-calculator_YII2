<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\user\UserRecord $model */

$this->title = 'Создать менеджера';
$this->params['breadcrumbs'][] = ['label' => 'User Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-record-create container py-6 mx-auto">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
        <div>
            <?= Html::a('Назад к списку', ['index'], ['class' => 'btn bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 text-sm']) ?>
        </div>
    </div>

    <div class="card shadow-lg rounded-lg border border-gray-200">
        <div class="card-body p-6">
            <?php $form = ActiveForm::begin(['options' => ['class' => 'space-y-4']]); ?>

            <div>
                <?= $form->field($model, 'name')->textInput(['class' => 'form-input block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500']) ?>
            </div>

            <div>
                <?= $form->field($model, 'username')->textInput(['class' => 'form-input block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500']) ?>
            </div>

            <div>
                <?= $form->field($model, 'password')->passwordInput(['class' => 'form-input block w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500']) ?>
            </div>

            <div class="mt-4">
                <?= Html::submitButton('Создать', ['class' => 'btn bg-blue-500 text-white px-6 py-3 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
