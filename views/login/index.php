<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/** @var yii\web\View $this */

$this->title = 'Вход';
?>
<div class="flex justify-center items-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 w-[800px] max-w-md text-[#1e3c72]">
        <h1 class="text-2xl font-bold text-center mb-6 text-[#1e3c72]"><?= Html::encode($this->title) ?></h1>

        <p class="text-[#1e3c72] text-center mb-4 ">Пожалуйста, заполните следующие поля для входа:</p>

        <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'fieldConfig' => [
                    'template' => "{label}\n{input}\n{error}",
                    'labelOptions' => ['class' => 'col-lg-1 col-form-label mr-lg-3'],
                    'inputOptions' => ['class' => 'col-lg-3 form-control'],
                    'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
                ],
            ]); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Имя пользователя',['class'=>'text-nowrap']) ?>

            <?= $form->field($model, 'password')->passwordInput()->label('Пароль') ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'template' => "<div class=\"custom-control custom-checkbox flex items-center gap-1\">{input} {label}</div>\n<div class=\"col-lg-8 text-center\">{error}</div>",
            ])->label('Запомнить меня') ?>


            <div class="form-group">
                <div>
                    <?= Html::submitButton('Войти', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end(); ?>
    </div>


</div>
