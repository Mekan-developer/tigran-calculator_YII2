<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Number Form';
?>

<!-- Success message alert -->
<?php if (Yii::$app->session->hasFlash('success')): ?>
    <div class="alert alert-success mb-4 p-4 bg-green-100 border-t-4 border-green-500 text-green-700">
        <?= Yii::$app->session->getFlash('success') ?>
    </div>
    <?php endif; ?>

    <!-- Flowbite styled form with Tailwind utility classes -->
<div class="max-w-lg mx-auto p-6 bg-white rounded-lg shadow-lg">
    <h1 class="text-3xl font-semibold text-center text-gray-800 mb-6">Enter Numbers</h1>
    
    <?php $form = ActiveForm::begin([
        'id' => 'numbers-form',
        'options' => ['class' => 'space-y-6'],
    ]); ?>

    <!-- Input for 'a' -->
    <div class="form-group">
        <?= $form->field($model, 'a')->input('number', [
            'class' => 'input input-bordered w-full p-3 border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400',
            'placeholder' => 'Enter value for a',
            ])->label(false) ?>
    </div>
    
    <!-- Input for 'b' -->
    <div class="form-group">
        <?= $form->field($model, 'b')->input('number', [
            'class' => 'input input-bordered w-full p-3 border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-blue-400',
            'placeholder' => 'Enter value for b',
            ])->label(false) ?>
    </div>
    
    <!-- Submit Button -->
    <div class="form-group">
        <?= Html::submitButton('Submit', [
            'class' => 'btn btn-primary w-full py-3 px-6 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<!-- Footer or additional content (optional) -->
<div class="text-center mt-8">
    <p>Form powered by Yii & Flowbite</p>
    <?= Html::encode($message) ?>
</div>

