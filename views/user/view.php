<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\user\UserRecord $model */

$this->title = "User Details: " . Html::encode($model->username);
$this->params['breadcrumbs'][] = ['label' => 'User Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-record-view container py-4">

    <div class="row mb-3">
        <div class="col">
            <h1 class="h3 text-primary"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="col text-end">
            <?= Html::a('<i class="bi bi-pencil"></i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
      
            <!-- // Html::a('<i class="bi bi-trash"></i> Delete', ['delete', 'id' => $model->id], [
            //     'class' => 'btn btn-danger btn-sm',
            //     'data' => [
            //         'confirm' => 'Are you sure you want to delete this item?',
            //         'method' => 'post',
            //     ],
            // ])  -->
        
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-bordered table-hover'], // Add Bootstrap 5 table styles
                'attributes' => [
                    [
                        'label' => 'User ID',
                        'value' => $model->id,
                        'contentOptions' => ['class' => 'text-center'],
                    ],
                    [
                        'label' => 'Username',
                        'value' => $model->username,
                    ],
                ],
            ]) ?>
        </div>
    </div>

</div>
