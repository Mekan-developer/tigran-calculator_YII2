<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\user\UserRecord $model */

$this->title = 'Update User Record: ' . Html::encode($model->username);
$this->params['breadcrumbs'][] = ['label' => 'User Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->username), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-record-update container py-4">

    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 text-primary"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col text-end">
            <?= Html::a('Back to User Details', ['view', 'id' => $model->id], ['class' => 'btn btn-secondary btn-sm']) ?>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
