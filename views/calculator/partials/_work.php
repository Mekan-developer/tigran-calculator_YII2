<template x-for="(item, index_no) in itemsMetal" :key="index_no">
    <div class="w-full">
        <div x-data="workFields(index_no)" class="p-4 mb-4 bg-[#96add4] text-[#172554] rounded-sm flex-1">
            <h2 class="mb-1 font-semibold text-md">РАБОТЫ</h2>
            <div id="work-fields-container">
                <!-- Render the initial fields -->
                <template x-for="(field, index) in fields" :key="index">
                    <div class="flex items-center mb-3 gap-4 work-field">
                        <!-- Remove button (visible for all fields except the first one) -->
                        <button x-show="index != 0" type="button" @click="removeField(index)" class="w-[34px] aspect-square text-white bg-red-600 rounded-sm hover:bg-red-700">
                            -
                        </button>
                        <!-- Add button (visible for the first field) -->
                        <button x-show="index == 0" type="button" @click="addField" class="w-[34px] aspect-square text-white bg-[#2a5298] rounded-sm hover:bg-[#3e6bb9]">
                            +
                        </button>

                        <div class="flex-1">
                            <select x-model="fields[index].work_id" :name="`WorkCalculation[${index_no}][${index}][work_id]`" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1">
                                <option value="" selected>Выберите работу</option>
                                <template x-for="(label, value) in workOptions" :key="value">
                                    <option :value="value" x-text="label" :selected="fields[index].work_id == value"></option>
                                </template>
                            </select>
                        </div>
                        <div class="flex-1">
                            <input type="text" x-model="fields[index].cost" :name="`WorkCalculation[${index_no}][${index}][cost]`" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Стоимость">
                        </div>
                    </div>
                </template>
                <!-- ИТОГО -->
                <div class="p-4 mb-4 bg-[#2a5298] text-white rounded-sm">
                    <div class="flex flex-row gap-2">
                        <span>Итого стоимость работ:</span><span>100</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ИТОГО -->
        <div class="p-4 mb-4 bg-green-600 rounded-sm">
            <h2 class="text-lg font-bold text-white">Итого стоимость изделия</h2>
            <p class="mt-2 text-lg font-semibold text-white">Итого: <span id="total-cost" class="text-xl font-bold">0</span> руб.</p>
        </div>
    </div>
</template>



<script>
   function workFields(index_no) {
        return {
            num:0,
            fields: [
                { work_id: '', cost: '' }
            ],
            workOptions: <?= json_encode(
                \yii\helpers\ArrayHelper::map(
                    app\models\Work::find()->select(['id', 'work_name'])->asArray()->all(),
                    'id',
                    'work_name'
                )
            ) ?>,


            addField() {
                let firstItem = this.fields[this.num];this.num++;
                console.log(firstItem);
                this.fields.push({ work_id: firstItem.work_id, cost: firstItem.cost });
            },

            removeField(index) {
                this.fields.splice(index, 1);this.num--;
                console.log(index + '---' + this.fields);
            },

            getFormattedData() {
                console.log('testGet');
                return {
                    [index_no]: this.fields.map((field, fieldIndex) => ({
                        work_id: field.work_id,
                        cost: field.cost,
                    })),
                };
            },
        };
    }

</script>
