<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\user\UserRecord $model */

$this->title = 'Обновить профиль: ';
$this->params['breadcrumbs'][] = ['label' => 'User Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->username), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-record-update container py-4">
    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 text-primary"><?= Html::encode($this->title) ?></h1>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name') ?>

        <?= $form->field($model, 'username') ?>

        <?= $form->field($model, 'password')->passwordInput() ?>  <!-- Password field -->

        <div class="form-group">
            <?= Html::submitButton('Обновить', ['class' => 'btn bg-[#2a5298] text-white hover:bg-[#172554]']) ?>
        </div>

        <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>