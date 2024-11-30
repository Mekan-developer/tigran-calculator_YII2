<?php

use app\models\CurrencyRateSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\CurrencyRateSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = "Курсы валют";
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="p-6 currency-rate-index bg-gray-50">

    <h1 class="text-xl font-bold text-gray-800"><?= Html::encode($this->title) ?></h1>
    <p class="mt-4">
        <?= Html::a('Создать запись', ['create'], [
            'class' => 'inline-block bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded shadow'
        ]) ?>
    </p>

    <!-- Search Form -->
    <div class="p-6 mt-4 bg-white rounded-lg shadow-md">
        <?php $form = ActiveForm::begin(['method' => 'get']); ?>

        <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
            <!-- Currency Input -->
            <?= $form->field($searchModel, 'currency')->dropDownList(
                CurrencyRateSearch::getCurrencyOptions(),
                [
                    'prompt' => 'Выберите валюту',
                    'class' => 'block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                ]
            )->label('Валюта') ?>

            <!-- Start Date Picker -->
            <?= $form->field($searchModel, 'date_from')->input('date', [
                'class' => 'block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                'max' => date('Y-m-d'),
                'min' => date('Y-m-d', strtotime('-10 days')),
            ])->label('Дата от') ?>

            <!-- End Date Picker -->
            <?= $form->field($searchModel, 'date_to')->input('date', [
                'class' => 'block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                'max' => date('Y-m-d'),
                'min' => date('Y-m-d', strtotime('-10 days')),
            ])->label('Дата до') ?>
        </div>

        <div class="flex justify-end mt-4">
            <?= Html::submitButton('Поиск', [
                'class' => 'px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600',
            ]) ?>
            <?= Html::a('Сбросить', ['index'], [
                'class' => 'ml-2 px-4 py-2 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-400',
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>

    <!-- GridView -->
    <div class="mt-6 overflow-x-auto">
        <?= GridView::widget([ 
            'dataProvider' => $dataProvider,
            'tableOptions' => ['class' => 'min-w-full bg-white border border-gray-200 shadow-sm rounded-lg'],
            'headerRowOptions' => ['class' => 'bg-gray-50 text-gray-700 text-sm uppercase tracking-wide'],
            'rowOptions' => function ($model, $key, $index, $grid) {
                return ['class' => $index % 2 === 0 ? 'bg-white' : 'bg-gray-50'];
            },
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'header' => '№',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600',
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800',
                    ],
                ],
                [
                    'attribute' => 'date',
                    'label' => 'Дата',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-center text-gray-800'],
                ],
                [
                    'attribute' => 'currency',
                    'label' => 'Валюта',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-center text-gray-800'],
                ],
                [
                    'attribute' => 'rate',
                    'label' => 'Курс, руб',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-center text-gray-800'],
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Действия',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-center text-gray-800'],
                    'template' => '{view} {update} {delete}',
                    'buttons' => [
                        'view' => function ($url) {
                            return Html::a(
                                '<i class="fas fa-eye"></i>',
                                $url,
                                ['title' => 'Просмотр', 'class' => 'text-blue-500 hover:underline mx-2']
                            );
                        },
                        'update' => function ($url) {
                            return Html::a(
                                '<i class="fas fa-edit"></i>',
                                $url,
                                ['title' => 'Обновить','class' => 'text-green-500 hover:underline mx-2']
                            );
                        },
                       'delete' => function ($url, $model, $key) {
                            return Html::tag('span', 
                                Html::beginForm(['delete', 'id' => $model->id], 'post', ['style' => 'display: inline;'])
                                . Html::submitButton('<i class="fas fa-trash"></i>', [
                                    'class' => 'text-red-500 hover:underline',
                                    'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                                    'style' => 'background: none; border: none; cursor: pointer;',
                                ])
                                . Html::endForm()
                                . Html::endTag('span')
                            );
                        },

                    ],
                ],
            ],
            'summary' => '<div class="px-6 py-4 text-sm text-gray-600">Показаны {begin}-{end} из {totalCount} элементов</div>',
            'pager' => [
                'options' => ['class' => 'flex justify-center py-4'],
                'linkOptions' => ['class' => 'mx-1 px-3 py-1 rounded-md border border-gray-300 text-gray-700 hover:bg-gray-100'],
            ],
        ]); ?>
    </div>
</div>
