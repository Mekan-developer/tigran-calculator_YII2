<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;

    /** @var yii\web\View $this */
    $this->title = 'Редактировать данные клиента';

?>


</div>
<div class="edit-client-data bg-gray-50 p-6 rounded shadow-lg">
    <h1 class="text-xl font-bold text-gray-800 mb-6"><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <!-- CLIENT DATA -->
    <h2 class="text-lg font-semibold text-blue-600 mb-4">Данные клиента</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-blue-100 p-4 rounded">
        <?= $form->field($clientModel, 'fio')->textInput(['class' => 'block w-full border-gray-300 rounded-sm px-2 py-1'])->label('ФИО') ?>
        <?= $form->field($clientModel, 'phone')->textInput(['class' => 'block w-full border-gray-300 rounded-sm px-2 py-1'])->label('Телефон') ?>
        <?= $form->field($clientModel, 'product_type')->textInput(['class' => 'block w-full border-gray-300 rounded-sm px-2 py-1'])->label('Тип изделия') ?>
        <?= $form->field($clientModel, 'calculation_date')->input('date', ['class' => 'block w-full border-gray-300 rounded-sm px-2 py-1'])->label('Дата расчёта') ?>
        <?= $form->field($clientModel, 'manager')->textInput(['class' => 'block w-full border-gray-300 rounded-sm px-2 py-1'])->label('Менеджер') ?>
    </div>

    <!-- METALS -->
    <h2 class="text-lg font-semibold text-pink-600 mt-8 mb-4">Металлы</h2>
    <div x-data='{
            itemsMetal: <?php echo json_encode($metalModel); ?>
        }' class="space-y-4">
        <template x-for="(item, index) in itemsMetal" :key="index">
            <div class="bg-pink-100 p-4 rounded relative">
                <div>
                    <label :for="'profile_' + index" class="block text-gray-700 font-medium">Профиль</label>
                    <input type="text" x-model="item.profile" :name="`itemsMetal[${index}][profile]`" :id="'profile_' + index" 
                        class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-pink-500 focus:border-pink-500" placeholder="Профиль">

                    <label :for="'height_' + index" class="block text-gray-700 font-medium">Высота</label>
                    <input type="text" x-model="item.height" :name="`itemsMetal[${index}][height]`" :id="'height_' + index"
                        class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-pink-500 focus:border-pink-500" placeholder="Высота">

                    <label :for="'width_' + index" class="block text-gray-700 font-medium">Ширина</label>
                    <input type="text" x-model="item.width" :name="`itemsMetal[${index}][width]`" :id="'width_' + index"
                        class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-pink-500 focus:border-pink-500" placeholder="Ширина">

                    <label :for="'ring_size_' + index" class="block text-gray-700 font-medium">Размер кольца</label>
                    <input type="text" x-model="item.ring_size" :name="`itemsMetal[${index}][ring_size]`" :id="'ring_size_' + index"
                        class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-pink-500 focus:border-pink-500" placeholder="Размер кольца">

                    <label :for="'metal_id_' + index" class="block text-gray-700 font-medium">Металл</label>
                    <select x-model="item.metal_id" :name="`itemsMetal[${index}][metal_id]`" :id="'metal_id_' + index"
                        class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-pink-500 focus:border-pink-500">
                        <option value="">Выберите металл</option>
                        <?php foreach (\yii\helpers\ArrayHelper::map(app\models\Metal::find()->all(), 'id', 'name') as $id => $name): ?>

                            <template  x-if="<?= $id ?> === item.metal_id">
                                <option :value="<?= $id ?>" selected><?= $name ?></option>
                            </template>
                            <template x-if="<?= $id ?> !== item.metal_id">
                                <option :value="<?= $id ?>"><?= $name ?></option>
                            </template>
                        <?php endforeach; ?>
                    </select>

                    <label :for="'tolerance_' + index" class="block text-gray-700 font-medium">Погрешность</label>
                    <input type="text" x-model="item.tolerance" :name="`itemsMetal[${index}][tolerance]`" :id="'tolerance_' + index"
                        class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-pink-500 focus:border-pink-500" placeholder="Погрешность">
                </div>
            </div>
        </template>
    </div>


    <!-- STONES -->
    <h2 class="text-lg font-semibold text-yellow-600 mt-8 mb-4">Камни</h2>
    <div x-data='{
        stones: <?php echo json_encode($stoneModelsData, JSON_HEX_TAG | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_HEX_APOS); ?>,
        addStone() {
            this.stones.push({ stone_id: "", cost_per_unit: "", max_possible: "", quantity: "", setting_cost: "" });
        },
        removeStone(index) {
            this.stones.splice(index, 1);
        }
    }' class="space-y-4" x-init="console.log(stones)">
    <template x-for="(stone, index) in stones" :key="index" >
        <div class="bg-yellow-100 p-4 rounded relative">
            <button type="button" class="absolute top-2 right-2 text-red-600" @click="removeStone(index)" x-show="index > 0">&times;</button>
            <div>
                <label :for="'stone_id_' + index" class="block text-gray-700 font-medium">Камень</label>
                <select x-model="stone.stone_id" :name="`StoneCalculation[${index}][stone_id]`" :id="'stone_id_' + index"
                    class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-yellow-500 focus:border-yellow-500">
                    <option value="">Выберите камень</option>
                    <?php foreach (\yii\helpers\ArrayHelper::map(app\models\Stone::find()->all(), 'id', 'material') as $id => $material): ?>
                        <template  x-if="<?= $id ?> === stone.stone_id">
                            <option :value="<?= $id ?>" selected><?= $material ?></option>
                        </template>
                        <template x-if="<?= $id ?> !== stone.stone_id">
                            <option :value="<?= $id ?>"><?= $material ?></option>
                        </template>
                    <?php endforeach; ?>
                </select>

                <label :for="'cost_per_unit_' + index" class="block text-gray-700 font-medium">Стоимость за единицу</label>
                <input type="text" x-model="stone.cost_per_unit" :name="`StoneCalculation[${index}][cost_per_unit]`" :id="'cost_per_unit_' + index"
                    class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-yellow-500 focus:border-yellow-500" placeholder="Стоимость за единицу">

                <label :for="'max_possible_' + index" class="block text-gray-700 font-medium">Максимально возможно</label>
                <input type="text" x-model="stone.max_possible" :name="`StoneCalculation[${index}][max_possible]`" :id="'max_possible_' + index"
                    class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-yellow-500 focus:border-yellow-500" placeholder="Максимально возможно">

                <label :for="'quantity_' + index" class="block text-gray-700 font-medium">Количество</label>
                <input type="text" x-model="stone.quantity" :name="`StoneCalculation[${index}][quantity]`" :id="'quantity_' + index"
                    class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-yellow-500 focus:border-yellow-500" placeholder="Количество">

                <label :for="'setting_cost_' + index" class="block text-gray-700 font-medium">Стоимость закрепки</label>
                <input type="text" x-model="stone.setting_cost" :name="`StoneCalculation[${index}][setting_cost]`" :id="'setting_cost_' + index"
                    class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-yellow-500 focus:border-yellow-500" placeholder="Стоимость закрепки">
            </div>
        </div>
    </template>
    <button type="button" @click="addStone()" class="bg-yellow-600 text-white px-4 py-2 rounded">
        Добавить камень
    </button>
</div>


    <!-- WORKS -->
    <h2 class="text-lg font-semibold text-green-600 mt-8 mb-4">Работы</h2>
    <div x-data='{
            works: <?= json_encode($workModels) ?>,
            addWork() {
                this.works.push({ work_id: "", cost: "" });
            },
            removeWork(index) {
                this.works.splice(index, 1);
            }
        }' class="space-y-4">
            <template x-for="(work, index) in works" :key="index">
                <div class="bg-green-100 p-4 rounded relative">
                    <button type="button" class="absolute top-2 right-2 text-red-600" @click="removeWork(index)" x-show="index > 0">&times;</button>
                    <div>
                        <label :for="'work_id_' + index" class="block text-gray-700 font-medium">Работа</label>
                        <select x-model="work.work_id" :name="`WorkCalculation[${index}][work_id]`" :id="'work_id_' + index"
                            class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-green-500 focus:border-green-500">
                            <option value="">Выберите работу</option>
                            <?php foreach (\yii\helpers\ArrayHelper::map(app\models\Work::find()->all(), 'id', 'work_name') as $id => $workName): ?>
                                <template  x-if="<?= $id ?> === work.work_id">
                                    <option :value="<?= $id ?>" selected><?= $workName ?></option>
                                </template>
                                <template x-if="<?= $id ?> !== work.work_id">
                                    <option :value="<?= $id ?>"><?= $workName ?></option>
                                </template>
                               
                            <?php endforeach; ?>
                        </select>

                        <label :for="'cost_' + index" class="block text-gray-700 font-medium">Стоимость</label>
                        <input type="text" x-model="work.cost" :name="`WorkCalculation[${index}][cost]`" :id="'cost_' + index"
                            class="block w-full border-gray-300 rounded-sm px-2 py-1 focus:ring-green-500 focus:border-green-500" placeholder="Введите стоимость">
                    </div>
                </div>
            </template>
        <button type="button" @click="addWork()" class="bg-green-600 text-white px-4 py-2 rounded">
            Добавить работу
        </button>
    </div>

    <!-- SUBMIT BUTTON -->
    <div class="form-group mt-8 flex justify-end">
        <?= Html::submitButton('Сохранить изменения', ['class' => 'px-6 py-2 bg-blue-600 text-white rounded-sm hover:bg-blue-700 transition']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
