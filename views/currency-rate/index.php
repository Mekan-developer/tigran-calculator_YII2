<?php

use app\models\CurrencyRateSearch;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\widgets\LinkPager;

/** @var yii\web\View $this */
/** @var app\models\CurrencyRateSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Курсы валют за 10 дней';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="currency-rate-index p-6 bg-gray-50">

    <h1 class="text-2xl font-bold text-gray-800"><?= Html::encode($this->title) ?></h1>

    <!-- Search Form -->
    <div class="mt-4 bg-white p-6 rounded-lg shadow-md">
        <?php $form = ActiveForm::begin(['method' => 'get']); ?>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Currency Input -->
            <?= $form->field($searchModel, 'currency')->dropDownList(
                CurrencyRateSearch::getCurrencyOptions(), // Fetch options from the search model
                [
                    'prompt' => 'Выберите валюту', // Default option
                    'class' => 'block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                ]
            )->label('Валюта') ?>


            <!-- Start Date Picker -->
            <?= $form->field($searchModel, 'date_from')->input('date', [
                    'class' => 'block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                    'max' => date('Y-m-d'), // Today's date
                    'min' => date('Y-m-d', strtotime('-10 days')), // Last 10 days
                ])->label('Дата от') ?>

                <!-- End Date Picker -->
                <?= $form->field($searchModel, 'date_to')->input('date', [
                    'class' => 'block w-full p-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500',
                    'max' => date('Y-m-d'), // Today's date
                    'min' => date('Y-m-d', strtotime('-10 days'))
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
                    'attribute' => 'date',
                    'header' => 'Дата',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-center text-gray-800'],
                ],
                [
                    'attribute' => 'currency',
                    'header' => 'Валюта',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-center text-gray-800'],
                ],
                [
                    'attribute' => 'rate',
                    'header' => 'Курс, руб',
                    'headerOptions' => ['class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'],
                    'contentOptions' => ['class' => 'px-4 py-2 text-center text-gray-800'],
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
