<div x-data="{
        fio: '',phone: '',product_type: '',calculation_date: '<?= date('Y-m-d') ?>', manager: ''
    }" 
    class="flex gap-4">
    <div class="flex-1 p-4 mb-4 bg-blue-100 rounded-sm">
        <h2 class="mb-1 font-semibold text-blue-800 text-md">ДАННЫЕ КЛИЕНТА</h2>
        <?= $form->field($clientModel, 'fio')->textInput([ 
            'maxlength' => true, 
            'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'fio',// To match the second input's readonly property
        ])->label('ФИО', ['class' => 'block text-[14px]']) ?>


        <?= $form->field($clientModel, 'phone')->textInput([
            'maxlength' => true, 
            'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'phone'
        ])->label('Телефон', ['class' => 'block text-[14px]']) ?>

        <?= $form->field($clientModel, 'product_type')->textInput([
            'maxlength' => true, 
            'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'product_type'
        ])->label('Тип изделия', ['class' => 'block text-[14px]']) ?>

        <?= $form->field($clientModel, 'calculation_date')->input('date', [
            'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'calculation_date',
        ])->label('Дата расчёта', ['class' => 'block text-[14px]']) ?>

        <?= $form->field($clientModel, 'manager')->textInput([
            'maxlength' => true, 
            'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'manager'
        ])->label('Менеджер', ['class' => 'block text-[14px]']) ?>
    </div>  
    <template x-for="(item,index) in itemsDiv" :key="index">
        <!-- Second Div -->
        <div class="p-4 mb-4 bg-blue-100 rounded-sm flex-1 relative">
            <div  @click="itemsDiv.splice(itemsDiv.length - 1, 1) && removeItem(index+1)" class="absolute top-4 right-4  text-yellow-600 cursor-pointer" >
                <i class="fa-solid fa-xmark"></i>
            </div>
            <h2 class="mb-1 font-semibold text-blue-800 text-md">ДАННЫЕ КЛИЕНТА</h2>
            <?= $form->field($clientModel, 'fio')->textInput([ 
                'maxlength' => true, 
                'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
                'x-model' => 'fio',// To match the second input's readonly property,
                    'readonly' => true,
            ])->label('ФИО', ['class' => 'block text-[14px]']) ?>


            <?= $form->field($clientModel, 'phone')->textInput([
                'maxlength' => true, 
                'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
                'x-model' => 'phone',
                    'readonly' => true,
            ])->label('Телефон', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'product_type')->textInput([
                'maxlength' => true, 
                'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
                'x-model' => 'product_type',
                    'readonly' => true,
            ])->label('Тип изделия', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'calculation_date')->input('date', [
                'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
                'x-model' => 'calculation_date',
                    'readonly' => true,
            ])->label('Дата расчёта', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'manager')->textInput([
                'maxlength' => true, 
                'class' => 'block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
                'x-model' => 'manager',
                    'readonly' => true,
            ])->label('Менеджер', ['class' => 'block text-[14px]']) ?>  
        </div>   
    </template>                                
</div>