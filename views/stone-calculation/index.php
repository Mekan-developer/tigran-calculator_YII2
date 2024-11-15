<?php

use app\models\StoneCalculation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stone Calculations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="stone-calculation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Stone Calculation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'client_id',
            'stone',
            'cost_per_unit',
            'max_possible',
            //'quantity',
            //'setting_cost',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, StoneCalculation $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
