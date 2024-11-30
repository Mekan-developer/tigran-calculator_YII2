<template x-for="(_, index_no) in itemsMetal" :key="index_no">
    <div x-data="stoneFields(index_no)" class="p-4 mb-4 bg-[#96add4] text-white rounded-sm flex-1">
        <h2 class="mb-1 font-semibold text-md">КАМНИ</h2>
        <div id="stone-fields-container">
            <!-- Initial fields -->
            <template x-for="(stoneField, index) in fields" :key="index">
                <div class="stone-field-group">
                    <div x-show="index != 0" class="w-full h-1 bg-white rounded-lg mb-4"></div>
                    <div class="flex flex-col flex-wrap gap-4 items-center mb-3 created-stone-field">
                        <div class="flex-1 flex flex-row gap-4 w-full">
                            <div>
                                <button type="button" x-show="index == 0" @click="addField()" class="w-[34px] aspect-square text-white bg-[#2a5298] rounded-sm hover:bg-[#3a67b4]">
                                    +
                                </button>
                                <button type="button" x-show="index != 0" @click="removeField(index)" class="w-[34px] aspect-square text-white bg-[#2a5298] rounded-sm hover:bg-[#3a67b4]">
                                    -
                                </button>
                            </div>
                            <div class="flex-1">
                                <select x-model="fields[index].stone_id" :name="`StoneCalculation[${index_no}][${index}][stone_id]`" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1">
                                    <option value="0">Выберите камень</option>
                                    <template x-for="(text, value) in stonesOptions">
                                        <option :value="value" x-text="text" :selected="fields[index].stone_id == value"></option>                       
                                    </template>
                                </select>
                            </div>
                        </div>
                        <div class="flex gap-4 w-full">
                            <div class="flex-1 text-nowrap min-w-[60px] overflow-hidden text-ellipsis" title="Введите стоимость за 1 шт">
                                <input type="text" x-model="fields[index].cost_per_unit" :name="`StoneCalculation[${index_no}][${index}][cost_per_unit]`" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Стоимость за 1 шт">
                            </div>
                            <div class="flex-1 text-nowrap min-w-[60px] overflow-hidden relative" title="Введите возможный максимум">
                                <input type="text" x-model="fields[index].max_possible" :name="`StoneCalculation[${index_no}][${index}][max_possible]`" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Возможный максимум">
                            </div>
                        </div>
                        <div class="flex gap-4 w-full">
                            <div class="flex-1 text-nowrap min-w-[60px] overflow-hidden relative" title="Введите количество">
                                <input type="text" x-model="fields[index].quantity" :name="`StoneCalculation[${index_no}][${index}][quantity]`" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Кол-во">
                            </div>
                            <div class="flex-1 text-nowrap min-w-[60px] overflow-hidden relative" title="Введите стоимость закрепки за 1 шт">
                                <input type="text" x-model="fields[index].setting_cost" :name="`StoneCalculation[${index_no}][${index}][setting_cost]`" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Стоимость закрепки за 1 шт">
                            </div>
                        </div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
    // Alpine.js data function for managing stone fields
    function stoneFields(index_no) {
        return {
            fields: [{ stone_id: '', cost_per_unit: '', max_possible: '', quantity: '', setting_cost: '' }],
            stonesOptions: <?= json_encode(
                \yii\helpers\ArrayHelper::map(
                    app\models\Stone::find()->all(),
                    'id',
                    function ($model) {
                        return $model->material . ' - ' . $model->cut . ' - (' . ($model->diameter ?: 'N/A') . ' мм - ' . ($model->height ?: 'N/A') . ' мм)';
                    }
                )
            ) ?>,
            addField() {
                let lastItem = this.fields[this.fields.length - 1];
                this.fields.push({ 
                    stone_id: lastItem.stone_id, 
                    cost_per_unit: lastItem.cost_per_unit, 
                    max_possible: lastItem.max_possible, 
                    quantity: lastItem.quantity, 
                    setting_cost: lastItem.setting_cost 
                });
                console.log(this.fields);
            },
            removeField(index) {
                if (index >= 0 && index < this.fields.length) {
                    this.fields.splice(index, 1);
                }
                console.log(index);
            },
            getFormattedData() {
                return {
                    [index_no]: this.fields.map(field => ({
                        stone_id: field.stone_id,
                        cost_per_unit: field.cost_per_unit,
                        max_possible: field.max_possible,
                        quantity: field.quantity,
                        setting_cost: field.setting_cost,
                    })),
                };
            },
        };
    }
</script>

