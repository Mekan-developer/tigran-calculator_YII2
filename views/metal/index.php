<?php

use app\models\Metal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Металлы';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="metal-index p-6 bg-gray-50">

    <h1 class="text-xl font-bold text-gray-800"><?= Html::encode($this->title) ?></h1>

    <div class="flex justify-end">
        <p class="mt-4">
            <?= Html::a('Создать метал', ['create'], [
                'class' => 'inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow'
            ]) ?>
        </p>
    </div>

    <div class="overflow-x-auto mt-6">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'min-w-full bg-white border border-gray-200 shadow-sm rounded-lg'],
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'header' => '№',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],
                [
                    'attribute' => 'name',
                    // 'header' => 'Name',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],
                [
                    'attribute' => 'density',
                    // 'header' => 'density',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],
                [
                    'class' => ActionColumn::className(),
                    'header' => 'Действия',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                    'urlCreator' => function ($action, Metal $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-eye"></i>', $url, [
                                'title' => 'View',
                                'class' => 'text-blue-500 hover:underline mx-2'
                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-edit"></i>', $url, [
                                'title' => 'Update',
                                'class' => 'text-green-500 hover:underline mx-2'
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::beginTag('span', ['style' => 'margin: 0 10px; display: inline;'])
                                . Html::beginForm(['delete', 'id' => $model->id], 'post', ['style' => 'display: inline;'])
                                . Html::submitButton('<i class="fas fa-trash"></i>', [
                                    'class' => 'text-red-500 hover:underline',
                                    'data-confirm' => 'Are you sure you want to delete this item?',
                                ])
                                . Html::endForm()
                                . Html::endTag('span');
                        },
                    ],
                ],
            ],
            'summary' => 'Показаны {begin}-{end} из {totalCount} элементов', // Custom Russian text
        ]); ?>
    </div>

</div>
