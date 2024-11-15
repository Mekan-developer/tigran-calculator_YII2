<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MetalCalculation $model */

$this->title = 'Create Metal Calculation';
$this->params['breadcrumbs'][] = ['label' => 'Metal Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metal-calculation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
