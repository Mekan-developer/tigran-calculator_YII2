<?php

use app\models\CurrencyRate;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Курсы валют';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="currency-rate-index p-6 bg-gray-50">

    <h1 class="text-2xl font-bold text-gray-800"><?= Html::encode($this->title) ?></h1>

    <div class="overflow-x-auto mt-6">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'min-w-full bg-white border border-gray-200 shadow-sm rounded-lg'],
            'columns' => [
                [
                    'attribute' => 'id',
                    'header' => 'ID',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],
                [
                    'attribute' => 'date',
                    'header' => 'Дата',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],
                [
                    'attribute' => 'currency',
                    'header' => 'Валюта',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],
                [
                    'attribute' => 'rate',
                    'header' => 'Курс, руб',
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
                    'urlCreator' => function ($action, CurrencyRate $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-eye"></i>', $url, [
                                'title' => 'Просмотр',
                                'class' => 'text-blue-500 hover:underline mx-2'
                            ]);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-edit"></i>', $url, [
                                'title' => 'Изменить',
                                'class' => 'text-green-500 hover:underline mx-2'
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::beginTag('span', ['style' => 'margin: 0 10px; display: inline;'])
                                . Html::beginForm(['delete', 'id' => $model->id], 'post', ['style' => 'display: inline;'])
                                . Html::submitButton('<i class="fas fa-trash"></i>', [
                                    'class' => 'text-red-500 hover:underline',
                                    'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                                ])
                                . Html::endForm()
                                . Html::endTag('span');
                        },
                    ],
                ],
            ],
            'summary' => '<div class="text-gray-600 text-sm px-6 py-4">Показаны {begin}-{end} из {totalCount} элементов</div>',
            'pager' => [
                'options' => ['class' => 'flex justify-center py-4'],
                'linkOptions' => ['class' => 'mx-1 px-3 py-1 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100'],
            ],
        ]); ?>
    </div>

</div>
