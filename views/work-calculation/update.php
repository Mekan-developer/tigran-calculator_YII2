<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\WorkCalculation $model */

$this->title = 'Update Work Calculation: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Work Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="work-calculation-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
