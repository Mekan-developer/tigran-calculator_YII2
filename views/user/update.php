<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\user\UserRecord $model */

$this->title = 'Обновить профиль: ' . Html::encode($model->username);
$this->params['breadcrumbs'][] = ['label' => 'User Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->username), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>

<div class="user-record-update container py-6 mx-auto">

    <!-- Header Section -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
    </div>

    <!-- Card with Form -->
    <div class="card shadow-lg rounded-lg border border-gray-200">
        <div class="card-body p-6">

            <?php $form = ActiveForm::begin(['options' => ['class' => 'space-y-6']]); ?>

            <!-- Name Field -->
            <div class="form-group">
                <?= $form->field($model, 'name')->textInput([
                    'class' => 'form-input block w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500'
                ]) ?>
            </div>

            <!-- Username Field -->
            <div class="form-group">
                <?= $form->field($model, 'username')->textInput([
                    'class' => 'form-input block w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500'
                ]) ?>
            </div>

            <!-- Password Field -->
            <div class="form-group">
                <?= $form->field($model, 'password')->passwordInput([
                    'class' => 'form-input block w-full px-4 py-3 border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500'
                ]) ?>
            </div>

            <!-- Submit Button -->
            <div class="mt-6">
                <?= Html::submitButton('Обновить', [
                    'class' => 'btn bg-blue-600 text-white px-6 py-3 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>

</div>
