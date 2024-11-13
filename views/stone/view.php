<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Stone $model */

$this->title = 'Stone Details - #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Stones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="min-h-screen flex items-center justify-center bg-gray-50 py-10">
    <div class="bg-white shadow-lg rounded-lg max-w-3xl w-full">
        
        <!-- Header -->
        <div class="flex justify-between items-center px-6 py-4 bg-gray-100 border-b border-gray-200">
            <h1 class="text-2xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
            <?= Html::a('Back to Stones', ['index'], ['class' => 'text-blue-600 hover:text-blue-700 font-medium']) ?>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex justify-end px-6 py-4 space-x-3">
            <?= Html::a('Update', ['update', 'id' => $model->id], [
                'class' => 'px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition'
            ]) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </div>
        
        <!-- Detail View -->
        <div class="p-6">
            <div class="overflow-hidden rounded-lg border border-gray-200">
                <table class="min-w-full bg-white">
                    <tbody>
                        <tr class="border-b">
                            <th class="w-1/3 px-6 py-4 text-left text-sm font-medium text-gray-500 bg-gray-100">ID</th>
                            <td class="px-6 py-4 text-sm text-gray-700"><?= Html::encode($model->id) ?></td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 bg-gray-100">Material</th>
                            <td class="px-6 py-4 text-sm text-gray-700"><?= Html::encode($model->material) ?></td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 bg-gray-100">Cut</th>
                            <td class="px-6 py-4 text-sm text-gray-700"><?= Html::encode($model->cut) ?></td>
                        </tr>
                        <tr class="border-b">
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 bg-gray-100">Diameter (mm)</th>
                            <td class="px-6 py-4 text-sm text-gray-700"><?= Html::encode($model->diameter) ?></td>
                        </tr>
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-medium text-gray-500 bg-gray-100">Height (mm)</th>
                            <td class="px-6 py-4 text-sm text-gray-700"><?= Html::encode($model->height) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>
