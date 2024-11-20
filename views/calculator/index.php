<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;

    /** @var yii\web\View $this */
    /** @var app\models\ClientData $clientModel */
    /** @var app\models\MetalCalculation $metalModel */
    /** @var app\models\StoneCalculation $stoneModel */
    /** @var app\models\WorkCalculation $workModels */
    $this->title = 'Калькулятор стоимости изделия';
?>


<div x-data="{
    itemsMetal: [{ profile: '', height: '', width: '', ring_size: '', metal_id: '', tolerance: '' }],
    addItem() {this.itemsMetal.push({ profile: '', height: '', width: '', ring_size: '', metal_id: '', tolerance: '' });},
    removeItem(index) {this.itemsMetal.splice(index, 1);}


}"

class="flex flex-row justify-around flex-1 gap-4" id="dynamic-pages-container">
    <div class="flex-1 p-4 rounded-sm shadow-lg calculation-form bg-gray-50">
        <?php $form = ActiveForm::begin(); ?>
        <div class="flex flex-col gap-4 p-4">
            <h1 class="mb-1 text-xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
            <div x-data="{ itemsDiv: [] }" class="flex gap-4 ">
            <input type="hidden" name="ClientSize" :value="JSON.stringify(itemsDiv)" >
                <div class="flex-1">
                    <!-- ДАННЫЕ КЛИЕНТА -->
                    <?php include('partials/_client.php'); ?>

                    <div class="flex gap-4">
                        <?php include('partials/_metal.php'); ?>
                    </div>

                    <!-- КАМНИ -->
                    <div class="flex gap-4">
                        <?php include('partials/_stone.php'); ?>
                    </div>

                    
                    <!-- РАБОТЫ -->
                    <div class="flex gap-4">
                        <?php include('partials/_work.php'); ?>
                    </div>  

                    <!-- ИТОГО -->
                    <div class="p-4 mb-4 bg-blue-200 rounded-sm">
                        <h2 class="text-lg font-bold text-blue-900">Итого стоимость изделия</h2>
                        <p class="mt-2 text-lg font-semibold text-blue-800">Итого: <span id="total-cost" class="text-xl font-bold">0</span> руб.</p>
                    </div>
                    <!-- Submit Button -->
                    
                </div>

                <div @click="itemsDiv.push(itemsDiv.length + 1) && addItem()"  x-show="itemsDiv.length !== 2" 
                    class="flex justify-center items-center w-[36px] h-[36px] bg-green-500 text-white rounded-sm cursor-pointer" >
                    +
                </div>
            </div>
            <div class="mt-4 form-group">
                <?= Html::submitButton('Сохранить все данные', ['class' => 'px-6 py-2 bg-green-600 text-white rounded-sm hover:bg-green-700 transition']) ?>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>


