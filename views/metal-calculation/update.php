<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MetalCalculation $model */

$this->title = 'Update Metal Calculation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Metal Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="metal-calculation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
