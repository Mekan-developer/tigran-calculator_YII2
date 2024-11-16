<?php

use app\models\Metal;
use app\models\Stone;
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
    <div class="flex flex-row justify-around flex-1 gap-4" id="dynamic-pages-container">
        <div class="flex-1 p-4 rounded-sm shadow-lg calculation-form bg-gray-50">

            <h1 class="mb-1 text-xl font-semibold text-gray-800"><?= Html::encode($this->title) ?></h1>
           

                <?php $form = ActiveForm::begin(); ?>

                <!-- ДАННЫЕ КЛИЕНТА -->
                <div class="p-4 mb-4 bg-blue-100 rounded-sm">
                    <h2 class="mb-1 font-semibold text-blue-800 text-md">ДАННЫЕ КЛИЕНТА</h2>
                    <?= $form->field($clientModel, 'fio')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500'])->label('ФИО') ?>
                    <?= $form->field($clientModel, 'phone')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500'])->label('Телефон') ?>
                    <?= $form->field($clientModel, 'product_type')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500'])->label('Тип изделия') ?>
                    <?= $form->field($clientModel, 'calculation_date')->input('date', ['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500'])->label('Дата расчёта') ?>
                    <?= $form->field($clientModel, 'manager')->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500'])->label('Менеджер') ?>
                </div>

                <!-- МЕТАЛЛ -->
                <div class="p-4 mb-4 bg-pink-100 rounded-sm">
                    <h2 class="mb-1 font-semibold text-pink-800 text-md">МЕТАЛЛ</h2>
                    <?= $form->field($metalModel, 'profile')->textInput(['maxlength' => true, 'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Профиль') ?>
                    <?= $form->field($metalModel, 'height')->textInput(['class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Высота') ?>
                    <?= $form->field($metalModel, 'width')->textInput(['class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Ширина') ?>
                    <?= $form->field($metalModel, 'ring_size')->textInput(['class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Размер кольца') ?>
                    <?= $form->field($metalModel, 'metal_id')->dropDownList(
                        \yii\helpers\ArrayHelper::map(Metal::find()->all(), 'id', 'name'),
                        [
                            'prompt' => 'Выберите металл',
                            'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'
                        ]
                    )->label('Металл') ?>
                    <?= $form->field($metalModel, 'tolerance')->textInput(['class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500'])->label('Погрешность, %') ?>
                </div>


                <!-- КАМНИ -->
                <div class="p-4 mb-4 bg-yellow-100 rounded-sm">
                    <h2 class="mb-1 font-semibold text-yellow-800 text-md">КАМНИ</h2>
                    <div id="stone-fields-container">
                        <?php if (!empty($stoneModels)): ?>
                            <?php foreach ($stoneModels as $index => $stoneModel): ?>
                                <div class="flex items-center mb-3 space-x-4">
                                    <div>
                                        <p class="invisible">|</p>
                                        <button type="button" id="add-stone-field" class="w-[40px] aspect-square text-white bg-yellow-600 rounded-sm hover:bg-yellow-700">
                                            + 
                                        </button>
                                    </div>
                                    <div class="flex-1">
                                        <?= $form->field($stoneModel, "[$index]stone_id")->dropDownList(
                                            \yii\helpers\ArrayHelper::map(
                                                Stone::find()->all(),
                                                'id',
                                                function ($model) {
                                                    return $model->material . ' - ' . $model->cut . ' - (' . $model->diameter . ' мм - ' . $model->height . ' мм)';
                                                }
                                            ),
                                            [
                                                'prompt' => 'Выберите камень',
                                                'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500'
                                            ]
                                        )->label('Камень') ?>
                                    </div>

                                    <div class="flex-1 text-nowrap min-w-[60px] overflow-hidden text-ellipsis"   title = 'Введите стоимость за 1 шт' >
                                        <?= $form->field($stoneModel, "[$index]cost_per_unit")->textInput([
                                            'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500 '
                                        ])->label('Стоимость за 1 шт') ?>
                                    </div>
                                    <div class="flex-1 text-nowrap min-w-[60px] overflow-hidden relative" title = 'Введите возможный максимум'>
                                        <?= $form->field($stoneModel, "[$index]max_possible")->textInput([
                                            'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500 '
                                        ])->label('Возможный максимум') ?>
                                    </div>
                                    <div class="flex-1 text-nowrap min-w-[60px] overflow-hidden relative" title = 'Введите количество' >
                                        <?= $form->field($stoneModel, "[$index]quantity")->textInput([
                                            'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500 '
                                        ])->label('Кол-во') ?>
                                    </div>
                                    <div class="flex-1 text-nowrap min-w-[60px] overflow-hidden relative" title = 'Введите стоимость закрепки за 1 шт'>
                                        <?= $form->field($stoneModel, "[$index]setting_cost")->textInput([
                                            'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500 '
                                        ])->label('Стоимость закрепки за 1 шт') ?>
                                    </div>

                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>



                <!-- РАБОТЫ -->
            
                <div class="p-4 mb-4 bg-green-100 rounded-sm">
                    <h2 class="mb-1 font-semibold text-green-800 text-md">РАБОТЫ</h2>
                    
                    <div id="work-fields-container">
                        <!-- Check if $workModels has any models, else initialize it -->
                        <?php if (!empty($workModels)): ?>
                            <?php foreach ($workModels as $index => $workModel): ?>
                                <div class="flex items-center mb-3 space-x-4">
                                    <div class>
                                        <p class="invisible">|</p>
                                        <button type="button" id="add-field" class="w-[40px] aspect-square text-white bg-green-600 rounded-sm hover:bg-green-700">
                                            +
                                        </button>
                                    </div>
                                    
                                    <div class="flex-1">
                                        <?= $form->field($workModel, "[$index]work_type")->textInput(['maxlength' => true, 'class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-green-500 focus:border-green-500'])->label('Тип работ') ?>
                                    </div>
                                    <div class="flex-1">
                                        <?= $form->field($workModel, "[$index]cost")->textInput(['class' => 'block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-green-500 focus:border-green-500'])->label('Стоимость') ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- ИТОГО -->
                <div class="p-4 mb-4 bg-blue-200 rounded-sm">
                    <h2 class="text-lg font-bold text-blue-900">Итого стоимость изделия</h2>
                    <p class="mt-2 text-lg font-semibold text-blue-800">Итого: <span id="total-cost" class="text-xl font-bold">0</span> руб.</p>
                </div>

                <!-- Submit Button -->
                <div class="mt-4 form-group">
                    <?= Html::submitButton('Сохранить все данные', ['class' => 'px-6 py-2 bg-green-600 text-white rounded-sm hover:bg-green-700 transition']) ?>
                </div>


                <?php ActiveForm::end(); ?>
              

        </div>
    </div>

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

    // <!-- КАМНИ -->
    document.addEventListener('DOMContentLoaded', function () {
        let stoneFieldsContainer = document.getElementById('stone-fields-container');

        // Add new stone field dynamically
        const addStoneButton = document.getElementById('add-stone-field');
        addStoneButton.addEventListener('click', function () {
            const index = stoneFieldsContainer.children.length;

            // Fetch stones options dynamically (pre-render them server-side if needed)
            const stonesOptions = <?= json_encode(
                // \yii\helpers\ArrayHelper::map(Stone::find()->all(), 'id', 'material')

   
                    \yii\helpers\ArrayHelper::map(
                        Stone::find()->all(),
                        'id',
                        function ($model) {
                            return $model->material . ' - ' . $model->cut . ' - (' . $model->diameter . ' мм - ' . $model->height . ' мм)';
                        }
                    ),
            ) ?>;
            const optionsHtml = Object.entries(stonesOptions)
                .map(([value, text]) => `<option value="${value}">${text}</option>`)
                .join('');

            const newFieldHtml = `
                <div class="flex items-center mb-3 space-x-4">
                    <button type="button" class="w-[40px] aspect-square text-white bg-yellow-600 rounded-sm hover:bg-yellow-700 remove-field">
                        -
                    </button>
                    <div class="flex-1">
                        <select name="StoneCalculation[${index}][stone_id]" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500">
                            <option value="" selected>Выберите камень</option>
                            ${optionsHtml}
                        </select>
                    </div>
                    <div class="flex-1">
                        <input type="text" name="StoneCalculation[${index}][cost_per_unit]" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500" placeholder="Стоимость за 1 шт">
                    </div>
                    <div class="flex-1">
                        <input type="text" name="StoneCalculation[${index}][max_possible]" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500" placeholder="Возможный максимум">
                    </div>
                    <div class="flex-1">
                        <input type="text" name="StoneCalculation[${index}][quantity]" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500" placeholder="Кол-во">
                    </div>
                    <div class="flex-1">
                        <input type="text" name="StoneCalculation[${index}][setting_cost]" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-yellow-500 focus:border-yellow-500" placeholder="Стоимость закрепки за 1 шт">
                    </div>
                </div>
            `;

            stoneFieldsContainer.insertAdjacentHTML('beforeend', newFieldHtml);
        });

        // Remove stone field dynamically
        stoneFieldsContainer.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-field')) {
                e.target.closest('.flex').remove();
            }
        });
    });


    // <!-- РАБОТЫ -->
    document.addEventListener('DOMContentLoaded', function () {
        // Initially show one field when the page loads
        let workFieldsContainer = document.getElementById('work-fields-container');

        // Add new fields dynamically when the button is clicked
        const addButton = document.getElementById('add-field');
        addButton.addEventListener('click', function () {
            const index = workFieldsContainer.children.length; // Calculate new index for new fields

            // New dynamic field HTML
            const newFieldHtml = `
                <div class="flex items-center mb-3 space-x-4">
                    <button type="button" class="w-[40px] aspect-square text-white bg-green-600 rounded-sm hover:bg-green-700 remove-field">
                        -
                    </button>
                    <div class="flex-1">
                        <input type="text" name="WorkCalculation[${index}][work_type]" class="block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-green-500 focus:border-green-500" placeholder="Тип работ">
                    </div>
                    <div class="flex-1">
                        <input type="text" name="WorkCalculation[${index}][cost]" class="block w-full  text-[14px] border border-gray-300 rounded-sm focus:ring-green-500 focus:border-green-500" placeholder="Стоимость">
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
