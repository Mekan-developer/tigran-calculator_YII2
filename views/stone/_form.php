<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Stone $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="stone-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'material')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'cut')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'diameter')->textInput() ?>

    <?= $form->field($model, 'height')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
