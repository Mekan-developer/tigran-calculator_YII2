<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\StoneCalculation $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stone-calculation-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->textInput() ?>

    <?= $form->field($model, 'stone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cost_per_unit')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'max_possible')->textInput() ?>

    <?= $form->field($model, 'quantity')->textInput() ?>

    <?= $form->field($model, 'setting_cost')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
