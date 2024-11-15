<?php

use app\models\MetalCalculation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Metal Calculations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="metal-calculation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Metal Calculation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'client_id',
            'profile',
            'height',
            'width',
            //'ring_size',
            //'metal',
            //'tolerance',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MetalCalculation $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
