<template x-for="(item, index_no) in itemsMetal" :key="index_no">
    <div x-data="workFields(index_no)" class="p-4 mb-4 bg-green-100 rounded-sm flex-1">
        <h2 class="mb-1 font-semibold text-green-800 text-md">РАБОТЫ</h2>
        <div id="work-fields-container">
            <!-- Render the initial fields -->
            <template x-for="(field, index) in fields" :key="index">
                <div class="flex items-center mb-3 gap-4 work-field">
                    <!-- Remove button (visible for all fields except the first one) -->
                    <button x-show="index != 0" type="button" @click="removeField(index)" class="w-[40px] aspect-square text-white bg-green-600 rounded-sm hover:bg-green-700">
                        -
                    </button>
                    <!-- Add button (visible for the first field) -->
                    <button x-show="index == 0" type="button" @click="addField" class="w-[40px] aspect-square text-white bg-green-600 rounded-sm hover:bg-green-700">
                        +
                    </button>

                    <div class="flex-1">
                        <select x-model="fields[index].work_id" :name="`WorkCalculation[${index_no}][${index}][work_id]`" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-green-500 focus:border-green-500">
                            <option value="" selected>Выберите работу</option>
                            <template x-for="(label, value) in workOptions" :key="value">
                                <option :value="value" x-text="label"></option>
                            </template>
                        </select>
                    </div>
                    <div class="flex-1">
                        <input type="text" x-model="fields[index].cost" :name="`WorkCalculation[${index_no}][${index}][cost]`" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-green-500 focus:border-green-500" placeholder="Стоимость">
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script>
   function workFields(index_no) {
        return {
            // Initialize fields with existing data or start with one empty field
            fields: [
                { work_id: '', cost: '' } // Default empty field
            ],
            workOptions: <?= json_encode(
                \yii\helpers\ArrayHelper::map(
                    app\models\Work::find()->all(),
                    'id',
                    'work_name'
                )
            ) ?>,

            // Add an empty field configuration
            addField() {
                this.fields.push({ work_id: '', cost: '' });
            },

            // Remove a field at the specified index
            removeField(index) {
                this.fields.splice(index, 1);
            },

            // Convert fields to a nested array structure
            getFormattedData() {
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
