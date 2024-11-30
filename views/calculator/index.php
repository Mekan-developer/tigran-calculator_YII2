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
    num:0,
    itemsMetal: [{ profile: '', height: '', width: '', ring_size: '', metal_id: '', tolerance: '',rounding:'' }],
    addItem() {
        // Push a new object with values copied from the first item in the array
        let firstItem = this.itemsMetal[this.num];
        this.itemsMetal.push({
            profile: firstItem.profile,
            height: firstItem.height,
            width: firstItem.width,
            ring_size: firstItem.ring_size,
            metal_id: firstItem.metal_id,
            rounding: firstItem.rounding,
            tolerance: firstItem.tolerance
        });
    },
    removeItem(index) {this.itemsMetal.splice(index, 1); this.num--;}


}"

class="flex flex-row justify-around flex-1 gap-4" id="dynamic-pages-container mt-4">
    <div class="flex-1 p-4 rounded-sm shadow-lg calculation-form bg-gray-200">
        <?php $form = ActiveForm::begin(); ?>
        <h1 class="text-xl font-bold text-[#172554] mb-2"><?= Html::encode($this->title) ?></h1>
        <div class="flex flex-col gap-4 ">
            
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

                    
                    <!-- Submit Button -->
                    
                </div>

                <div @click="itemsDiv.push(itemsDiv.length + 1); addItem(); num++"  x-show="itemsDiv.length !== 2" 
                    class="flex justify-center items-center w-[36px] h-[36px] bg-[#2a5298] text-white rounded-sm cursor-pointer" >
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


