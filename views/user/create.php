<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\user\UserRecord $model */

$this->title = 'Create User Record';
$this->params['breadcrumbs'][] = ['label' => 'User Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-record-create container py-4">

    <div class="row mb-4">
        <div class="col">
            <h1 class="h3 text-primary"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col text-end">
            <?= Html::a('Back to List', ['index'], ['class' => 'btn btn-secondary']) ?>
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
