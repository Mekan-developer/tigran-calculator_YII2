<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\ClientData $model */

$this->title = 'Update Client Data: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Client Datas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="client-data-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
