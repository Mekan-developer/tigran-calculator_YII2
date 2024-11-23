<?php

use app\models\ClientData;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'База расчётов';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="client-data-index p-6 bg-gray-50">

    <h1 class="text-2xl font-bold text-gray-800"><?= Html::encode($this->title) ?></h1>

    <!-- Create Client Data Button -->
   
    
    <p class="mt-4">
        
    <?php
        /*
        <?= Html::a('Создать данные клиента', ['create'], [
            'class' => 'inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow'
        ]) ?>
        */
        ?>

    </p>

    <!-- GridView -->
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
                    'attribute' => 'calculation_date',
                    'label' => 'Дата расчета',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],
                [
                    'attribute' => 'fio',
                    'header' => 'ФИО',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],
                [
                    'attribute' => 'phone',
                    'header' => 'Телефон',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],
                [
                    'attribute' => 'product_type',
                    'header' => 'Тип изделия',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],
                
                [
                    'attribute' => 'manager',
                    'label' => 'Менеджер',
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
                    'urlCreator' => function ($action, ClientData $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-eye"></i>', $url, [
                                'title' => 'Просмотр',
                                'class' => 'text-blue-500 hover:underline mx-2'
                            ]);
                        },
                        'edit' => function ($url, $model, $key) {
                            return Html::a('<i class="fas fa-pen"></i>', $url, [
                                'title' => 'Просмотр',
                                'class' => 'text-blue-500 hover:underline mx-2'
                            ]);
                        },
                        // 'delete' => function ($url, $model, $key) {
                        //     return Html::a('<i class="fas fa-trash-alt"></i>', $url, [
                        //         'title' => 'Удалить',
                        //         'class' => 'text-red-500 hover:underline mx-2',
                        //         'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?', // Confirmation dialog
                        //         'data-method' => 'post', // Send the request as POST
                        //     ]);
                        // },
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
                    'template' => '{view}{edit}{delete}', // Only render the view button
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
