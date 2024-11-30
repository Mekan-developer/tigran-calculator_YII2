<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\user\UserRecord $model */

$this->title = 'Создать менеджера';
$this->params['breadcrumbs'][] = ['label' => 'User Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-record-create container py-4">

    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 text-primary"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col text-end">
            <?= Html::a('Назад к списку', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
        <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'name') ?>
            <?= $form->field($model, 'username') ?>

            <?= $form->field($model, 'password')->passwordInput() ?>  <!-- Password field -->

            <div class="form-group">
                <?= Html::submitButton('Создать', ['class' => 'btn bg-[#2a5298] text-white hover:bg-[#172554]']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
