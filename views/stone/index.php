<?php

use app\models\Stone;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Stones';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="stone-index mx-auto max-w-7xl p-6 bg-gray-50">

    <h1 class="text-2xl font-bold text-gray-800"><?= Html::encode($this->title) ?></h1>

    <p class="mt-4">
        <?= Html::a('Create Stone', ['create'], ['class' => 'inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow']) ?>
    </p>

    <div class="overflow-x-auto mt-6">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'min-w-full bg-white border border-gray-200 shadow-sm rounded-lg'],
            'columns' => [
                ['class' => 'yii\grid\SerialColumn', 'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-left text-sm font-medium text-gray-600']],

                [
                    'attribute' => 'id',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-left text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-gray-800'],
                ],
                [
                    'attribute' => 'material',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-left text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-gray-800'],
                ],
                [
                    'attribute' => 'cut',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-left text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-gray-800'],
                ],
                [
                    'attribute' => 'diameter',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-left text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-gray-800'],
                ],
                [
                    'attribute' => 'height',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-left text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-gray-800'],
                ],
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Stone $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-left text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-gray-800 text-center'],
                ],
            ],
        ]); ?>
    </div>

</div>
