<?php

use yii\db\Query;
use app\models\user\UserRecord;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\user\UserSearchModel $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Записи о менеджерах';  // "User Records"
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-record-index container py-6 mx-auto">

    <div class="flex justify-between items-center mb-4">
        <h1 class="text-3xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
        <?= Html::a('Создать запись пользователя', ['create'], ['class' => 'btn bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm']) ?>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],

                [
                    'class' => 'yii\grid\DataColumn', // Display username
                    'attribute' => 'username',
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                ],

                [
                    'class' => ActionColumn::className(),
                    'header' => 'Действия', // "Actions"
                    'headerOptions' => [
                        'class' => 'bg-gray-100 px-4 py-2 text-center text-sm font-medium text-gray-600'
                    ],
                    'contentOptions' => [
                        'class' => 'px-4 py-2 text-center text-gray-800'
                    ],
                    'template' => '{update} {delete}',
                    'urlCreator' => function ($action, UserRecord $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                    'buttons' => [
                        'update' => function ($url, $model, $key) {
                            return Html::a('<i class="bi bi-pencil"></i>', $url, [
                                'class' => 'btn bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 text-sm',
                                'title' => 'Обновить', // "Update"
                                'aria-label' => 'Обновить', // "Update"
                            ]);
                        },
                        'delete' => function ($url, $model, $key) {
                            return Html::a('<i class="bi bi-trash"></i>', $url, [
                                'class' => 'btn bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 text-sm',
                                'title' => 'Удалить', // "Delete"
                                'aria-label' => 'Удалить', // "Delete"
                                'data-confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                                'data-method' => 'post',
                            ]);
                        },
                    ],
                ],
            ],
            'rowOptions' => function ($model, $index, $widget, $grid) {
                // Hide a specific row based on a condition
                $authAssignments = (new Query())
                    ->select(['user_id', 'item_name', 'created_at'])
                    ->from('auth_assignment')
                    ->where(['item_name' => 'admin'])
                    ->one();

                if ($authAssignments['user_id'] == $model->id) {
                    return ['style' => 'display:none']; // Hide the row
                }

                return []; // Keep row visible
            },
            'summary' => '',
        ]); ?>
    </div>

</div>
