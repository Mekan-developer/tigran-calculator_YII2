<?php
    use rmrevin\yii\fontawesome\FA;
    use yii\helpers\ArrayHelper;
    use yii\db\Query;




// *******************
    $auth = Yii::$app->authManager;
    $role = $auth->getRole('manager');

    $query = new Query();
    $userAssignments = $query->select('user_id')
        ->from('{{%auth_assignment}}')
        ->where(['item_name' => $role->name])
        ->all();

    if (!empty($userAssignments)) {
        $userIds = array_column($userAssignments, 'user_id');
        $managers = (new Query())
            ->select(['id', 'name'])
            ->from('{{%user}}') // Ensure correct table name with prefix
            ->where(['id' => $userIds])
            ->all();
        $managerList = ArrayHelper::map($managers, 'id', 'name');
    } else {
        $managerList = [];
    }
    // Get the currently authenticated user ID
    $currentUserId = Yii::$app->user->identity->id;
    $isManager = ($currentUserId != 1);
?>


<div x-data="{
        fio: '',phone: '',product_type: '',calculation_date: '<?= date('Y-m-d') ?>', user_id:<?= $currentUserId ?? 0 ?>
    }" 
    class="flex gap-4">
    <div class="flex-1 p-4 mb-4 bg-[#96add4] text-[#172554]">
        <h2 class="mb-1 font-semibold text-[#172554] text-md">ДАННЫЕ КЛИЕНТА</h2>
        <?= $form->field($clientModel, 'fio')->textInput([ 
            'maxlength' => true, 
            'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'fio',// To match the second input's readonly property
            'placeholder' => 'Введите ФИО'
        ])->label('ФИО', ['class' => 'block text-[14px]']) ?>


        <?= $form->field($clientModel, 'phone')->textInput([
            'maxlength' => true, 
            'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'phone',
            'placeholder' => 'Введите телефон'
        ])->label('Телефон', ['class' => 'block text-[14px]']) ?>

        <?= $form->field($clientModel, 'product_type')->textInput([
            'maxlength' => true, 
            'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'product_type',
            'placeholder' => 'Введите тип изделия'
        ])->label('Тип изделия', ['class' => 'block text-[14px]']) ?>

        <?= $form->field($clientModel, 'calculation_date')->input('date', [
            'class' => 'block w-full text-[14px] text-[#172554]  border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'calculation_date',
        ])->label('Дата расчёта', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'user_id')->dropDownList(
                $managerList, // List of manager options
                [
                    'prompt' => 'Выберите менеджера', // Placeholder option
                    'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1',
                    'x-model' => 'user_id', // Alpine.js binding if needed
                    'value' => $currentUserId, // Set the value to the authenticated user's ID by default
                    'onmousedown' => $isManager? 'return false' : 'return true', // Prevents user interaction with the dropdown
                ]
            )->label('Менеджер', ['class' => 'block text-[14px]']); ?>

    </div>  
    <template x-for="(item,index) in itemsDiv" :key="index">
        <!-- Second Div -->
        <div class="p-4 mb-4 bg-[#96add4] text-[#172554] rounded-sm flex-1 relative">
            <div @click="itemsDiv.splice(itemsDiv.length - 1, 1) && removeItem(index+1)" 
                class="absolute flex items-center justify-center top-1 right-1 cursor-pointer ">
                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                    <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 6.793l2.646-2.647a.5.5 0 0 1 .708.708L8.707 7.5l2.647 2.646a.5.5 0 0 1-.708.708L8 8.207l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 7.5 4.646 4.854a.5.5 0 0 1 0-.708z"/>
                </svg> -->
                <img src="data:image/png;base64,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" alt="cross-mark-button-emoji">
            </div>
            <h2 class="mb-1 font-semibold text-md">ДАННЫЕ КЛИЕНТА</h2>
            <?= $form->field($clientModel, 'fio')->textInput([ 
                'maxlength' => true, 
                'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm bg-gray-200 px-2 py-1', 
                'x-model' => 'fio',// To match the second input's readonly property,
                'placeholder' => 'Введите ФИО',
                'readonly' => true,
            ])->label('ФИО', ['class' => 'block text-[14px]']) ?>


            <?= $form->field($clientModel, 'phone')->textInput([
                'maxlength' => true, 
                'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm bg-gray-200 px-2 py-1', 
                'x-model' => 'phone',
                'placeholder' => 'Введите телефон',
                'readonly' => true,
            ])->label('Телефон', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'product_type')->textInput([
                'maxlength' => true, 
                'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm bg-gray-200 px-2 py-1', 
                'x-model' => 'product_type',
            'placeholder' => 'Введите тип изделия',
                'readonly' => true,
            ])->label('Тип изделия', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'calculation_date')->input('date', [
                'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm bg-gray-200 px-2 py-1', 
                'x-model' => 'calculation_date',
                    'readonly' => true,
            ])->label('Дата расчёта', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'user_id')->dropDownList(
                $managerList, // List of manager options
                [
                    'prompt' => 'Выберите менеджера', // Placeholder option
                    'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm bg-gray-200 px-2 py-1',
                    'x-model' => 'user_id', // Alpine.js binding if needed
                    'value' => $currentUserId, // Set the value to the authenticated user's ID by default
                    'disabled' => true, // This disables the dropdown (read-only)
                ]
            )->label('Менеджер', ['class' => 'block text-[14px]']); ?>
        </div>   
    </template>                                
</div>