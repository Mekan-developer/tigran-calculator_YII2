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

<div class="flex gap-4 p-4 ">
<?php for( $i=1; $i<=3;$i++){ ?>
    <div class="flex-1 flex flex-row gap-4 justify-around" id="dynamic-pages-container">
        <div class="calculation-form bg-gray-50 p-4 rounded-sm shadow-lg flex-1">

            <h1 class="text-xl font-semibold text-gray-800 mb-1"><?= Html::encode($this->title) ?></h1>
           

                <?php $form = ActiveForm::begin(); ?>

                <!-- ДАННЫЕ КЛИЕНТА -->
                <div class="bg-blue-100 p-4 rounded-sm mb-4">
                    <h2 class="text-md font-semibold text-blue-800 mb-1">ДАННЫЕ КЛИЕНТА</h2>
                    <?= $form->field($clientModel, 'fio')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500'])->label('ФИО') ?>
                    <?= $form->field($clientModel, 'phone')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500'])->label('Телефон') ?>
                    <?= $form->field($clientModel, 'product_type')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500'])->label('Тип изделия') ?>
                    <?= $form->field($clientModel, 'calculation_date')->input('date', ['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500'])->label('Дата расчёта') ?>
                    <?= $form->field($clientModel, 'manager')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500'])->label('Менеджер') ?>
                </div>

                <!-- МЕТАЛЛ -->
                <div class="bg-pink-100 p-4 rounded-sm mb-4">
                    <h2 class="text-md font-semibold text-pink-800 mb-1">МЕТАЛЛ</h2>
                    <?= $form->field($metalModel, 'profile')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Профиль') ?>
                    <?= $form->field($metalModel, 'height')->textInput(['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Высота') ?>
                    <?= $form->field($metalModel, 'width')->textInput(['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Ширина') ?>
                    <?= $form->field($metalModel, 'ring_size')->textInput(['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Размер кольца') ?>
                    <?= $form->field($metalModel, 'metal')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Металл') ?>
                    <?= $form->field($metalModel, 'tolerance')->textInput(['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Погрешность, %') ?>
                </div>

                <!-- КАМНИ -->
                <div class="bg-yellow-100 p-4 rounded-sm mb-4">
                    <h2 class="text-md font-semibold text-yellow-800 mb-1">КАМНИ</h2>
                    <?= $form->field($stoneModel, 'stone')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500'])->label('Камень') ?>
                    <?= $form->field($stoneModel, 'cost_per_unit')->textInput(['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500'])->label('Стоимость за 1 шт') ?>
                    <?= $form->field($stoneModel, 'max_possible')->textInput(['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500'])->label('Возможный максимум') ?>
                    <?= $form->field($stoneModel, 'quantity')->textInput(['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500'])->label('Кол-во') ?>
                    <?= $form->field($stoneModel, 'setting_cost')->textInput(['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500'])->label('Стоимость закрепки за 1 шт') ?>
                </div>

                <!-- РАБОТЫ -->
            
                <div class="bg-green-100 p-4 rounded-sm mb-4">
                    <h2 class="text-md font-semibold text-green-800 mb-1">РАБОТЫ</h2>
                    
                    <div id="work-fields-container">
                        <!-- Check if $workModels has any models, else initialize it -->
                        <?php if (!empty($workModels)): ?>
                            <?php foreach ($workModels as $index => $workModel): ?>
                                <div class="flex items-center space-x-4 mb-3">
                                    <div>
                                        <p class="invisible">|</p>
                                        <button type="button" id="add-field" class="px-4 py-2 bg-green-600 text-white rounded-sm hover:bg-green-700">
                                            +
                                        </button>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <?= $form->field($workModel, "work_type[$index]")->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-green-500 focus:border-green-500'])->label('Тип работ') ?>
                                    </div>
                                    <div class="flex-1">
                                        <?= $form->field($workModel, "cost[$index]")->textInput(['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-green-500 focus:border-green-500'])->label('Стоимость') ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ИТОГО -->
                <div class="bg-blue-200 p-4 rounded-sm mb-4">
                    <h2 class="text-lg font-bold text-blue-900">Итого стоимость изделия</h2>
                    <p class="text-blue-800 text-lg font-semibold mt-2">Итого: <span id="total-cost" class="font-bold text-xl">0</span> руб.</p>
                </div>

                <!-- Submit Button -->
                <div class="form-group mt-4">
                    <?= Html::submitButton('Сохранить все данные', ['class' => 'px-6 py-2 bg-green-600 text-white rounded-sm hover:bg-green-700 transition']) ?>
                </div>


                <?php ActiveForm::end(); ?>
              

        </div>
    </div>
    <?php } ?> 
    <div class="flex justify-center items-center leading-7 w-[36px] h-[36px] bg-green-500 text-white rounded-md">
        <button id="add-new-page" class="w-full h-full" >+</button>
    </div>
</div>





<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addButton = document.getElementById('add-new-page');
        const pagesContainer = document.getElementById('dynamic-pages-container');

        // Add a page when the "+" button is clicked
        addButton.addEventListener('click', function () {
            // Clone the first page (structure)
            const newPage = pagesContainer.children[0].cloneNode(true);

            // Clear input fields of the cloned page
            const inputs = newPage.querySelectorAll('input');
            inputs.forEach(input => input.value = '');

            // Append the new page
            pagesContainer.appendChild(newPage);
        });
    });


    document.addEventListener('DOMContentLoaded', function () {
        // Initially show one field when the page loads
        let workFieldsContainer = document.getElementById('work-fields-container');

        // Add new fields dynamically when the button is clicked
        const addButton = document.getElementById('add-field');
        addButton.addEventListener('click', function () {
            const index = workFieldsContainer.children.length; // Calculate new index for new fields

            // New dynamic field HTML
            const newFieldHtml = `
                <div class="flex items-center space-x-4 mb-3">
                    <button type="button" class="px-4 py-2 bg-green-600 text-white rounded-sm hover:bg-green-700 remove-field">
                        -
                    </button>
                    <div class="flex-1">
                        <input type="text" name="WorkCalculation[work_type][${index}]" class="block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-green-500 focus:border-green-500" placeholder="Тип работ">
                    </div>
                    <div class="flex-1">
                        <input type="text" name="WorkCalculation[cost][${index}]" class="block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-green-500 focus:border-green-500" placeholder="Стоимость">
                    </div>
                </div>
            `;

            // Add the new field to the container
            workFieldsContainer.insertAdjacentHTML('beforeend', newFieldHtml);
        });

        // Remove a field dynamically when [ - ] is clicked
        workFieldsContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-field')) {
                e.target.closest('.flex').remove();
            }
        });
    });

</script>
