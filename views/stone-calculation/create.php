<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\StoneCalculation $model */

$this->title = 'Create Stone Calculation';
$this->params['breadcrumbs'][] = ['label' => 'Stone Calculations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stone-calculation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
