<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Metal $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Металлы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="flex items-center justify-center min-h-screen bg-gradient-to-r from-gray-100 to-gray-200 py-10">
    <div class="w-full max-w-3xl bg-white rounded-lg shadow-lg">
        
        <!-- Header -->
        <div class="px-6 py-4 border-b border-gray-200 flex items-center justify-between">
            <h1 class="text-2xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
            <div>
                <?= Html::a('Редактировать', ['update', 'id' => $model->id], [
                    'class' => 'inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition',
                ]) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'inline-block bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition',
                    'data' => [
                        'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>

        <!-- Content -->
        <div class="p-8 space-y-6">
            <table class="w-full border border-gray-200 rounded-lg shadow-sm bg-gray-50">
                <tbody>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left text-gray-700 font-medium bg-gray-100 w-1/3">ID</th>
                        <td class="px-4 py-2 text-gray-800"><?= Html::encode($model->id) ?></td>
                    </tr>
                    <tr class="border-b">
                        <th class="px-4 py-2 text-left text-gray-700 font-medium bg-gray-100 w-1/3">Название</th>
                        <td class="px-4 py-2 text-gray-800"><?= Html::encode($model->name) ?></td>
                    </tr>
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700 font-medium bg-gray-100 w-1/3">Плотность</th>
                        <td class="px-4 py-2 text-gray-800"><?= Html::encode($model->density) ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
