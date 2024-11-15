<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\WorkCalculation $model */

$this->title = 'Create Work Calculation';
$this->params['breadcrumbs'][] = ['label' => 'Work Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="work-calculation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
