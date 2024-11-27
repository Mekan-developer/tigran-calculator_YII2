<?php

use app\models\user\UserRecord;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\user\UserSearchModel $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Записи пользователей';  // "User Records"
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-record-index container py-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1 class="h3"> <?= Html::encode($this->title) ?> </h1>
   
       <?= Html::a('Создать запись пользователя', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
       
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="table-responsive">
        <?= GridView::widget([
               'summary' => '',
            'dataProvider' => $dataProvider,
            // 'filterModel' => $searchModel,
            'tableOptions' => ['class' => 'table table-striped table-bordered table-hover align-middle'], // Классы таблицы Bootstrap 5
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn', // Используется для серийных номеров, без 'attribute'
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],

                [
                    'class' => 'yii\grid\DataColumn', // Отображение имени пользователя в обычной колонке данных
                    'attribute' => 'username', // Атрибут
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],                
                

                [
                    'class' => ActionColumn::className(),
                    'header' => 'Действия',  // "Actions"
                    'headerOptions' => ['class' => 'text-center'],
                    'contentOptions' => ['class' => 'text-center'], // Центрирование кнопок действий
                    'template' => ' {update}', // Это гарантирует, что будет отображен значок удаления
                    'urlCreator' => function ($action, UserRecord $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'buttons' => [
                        // 'view' => function ($url, $model, $key) {
                        //     return Html::a('<i class="bi bi-eye"></i>', $url, [
                        //         'class' => 'btn btn-primary btn-sm',
                        //         'title' => 'Просмотр', // "View"
                        //         'aria-label' => 'Просмотр', // "View"
                        //     ]);
                        // },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="bi bi-pencil"></i>', $url, [
                                'class' => 'btn btn-warning btn-sm',
                                'title' => 'Обновить', // "Update"
                                'aria-label' => 'Обновить', // "Update"
                            ]);
                        }
                        // 'delete' => function ($url, $model, $key) {
                        //     return Html::a('<i class="bi bi-trash"></i>', $url, [
                        //         'class' => 'btn btn-danger btn-sm',
                        //         'title' => 'Удалить', // "Delete"
                        //         'aria-label' => 'Удалить', // "Delete"
                        //         'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?', // "Are you sure you want to delete this item?"
                        //         'data-method' => 'post',
                        //     ]);
                        // },
                    ]

                ],
            ],
        ]); ?>
    </div>

</div>
