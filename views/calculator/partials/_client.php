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
        fio: '',phone: '',product_type: '',calculation_date: '<?= date('Y-m-d') ?>', manager:<?= $currentUserId ?? 0 ?>
    }" 
    class="flex gap-4">
    <div class="flex-1 p-4 mb-4 bg-[#96add4]  rounded-t-lg text-[#172554]">
        <h2 class="mb-1 font-semibold text-[#172554] text-md">ДАННЫЕ КЛИЕНТА</h2>
        <?= $form->field($clientModel, 'fio')->textInput([ 
            'maxlength' => true, 
            'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'fio',// To match the second input's readonly property
        ])->label('ФИО', ['class' => 'block text-[14px]']) ?>


        <?= $form->field($clientModel, 'phone')->textInput([
            'maxlength' => true, 
            'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'phone'
        ])->label('Телефон', ['class' => 'block text-[14px]']) ?>

        <?= $form->field($clientModel, 'product_type')->textInput([
            'maxlength' => true, 
            'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'product_type'
        ])->label('Тип изделия', ['class' => 'block text-[14px]']) ?>

        <?= $form->field($clientModel, 'calculation_date')->input('date', [
            'class' => 'block w-full text-[14px] text-[#172554]  border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
            'x-model' => 'calculation_date',
        ])->label('Дата расчёта', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'manager')->dropDownList(
                $managerList, // List of manager options
                [
                    'prompt' => 'Выберите менеджера', // Placeholder option
                    'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1',
                    'x-model' => 'manager', // Alpine.js binding if needed
                    'value' => $currentUserId, // Set the value to the authenticated user's ID by default
                    'disabled' => $isManager, // This disables the dropdown
                ]
            )->label('Менеджер', ['class' => 'block text-[14px]']); ?>

        <?php 
        // $form->field($clientModel, 'manager')->textInput([
        //     'maxlength' => true, 
        //     'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 px-2 py-1', 
        //     'x-model' => 'manager'
        // ])->label('Менеджер', ['class' => 'block text-[14px]']) 
        ?>
    </div>  
    <template x-for="(item,index) in itemsDiv" :key="index">
        <!-- Second Div -->
        <div class="p-4 mb-4 bg-[#96add4] text-[#172554] rounded-sm flex-1 relative">
            <div  @click="itemsDiv.splice(itemsDiv.length - 1, 1) && removeItem(index+1)" class="absolute flex items-center justify-center top-4 right-4 cursor-pointer w-[32px] aspect-square rounded-full bg-[#172554]" >
                <span class="text-red-600"><?php echo FA::icon('circle-xmark')->fixedWidth()->pullLeft(); ?></span>
            </div>
            <h2 class="mb-1 font-semibold text-md">ДАННЫЕ КЛИЕНТА</h2>
            <?= $form->field($clientModel, 'fio')->textInput([ 
                'maxlength' => true, 
                'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm bg-gray-200 px-2 py-1', 
                'x-model' => 'fio',// To match the second input's readonly property,
                    'readonly' => true,
            ])->label('ФИО', ['class' => 'block text-[14px]']) ?>


            <?= $form->field($clientModel, 'phone')->textInput([
                'maxlength' => true, 
                'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm bg-gray-200 px-2 py-1', 
                'x-model' => 'phone',
                    'readonly' => true,
            ])->label('Телефон', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'product_type')->textInput([
                'maxlength' => true, 
                'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm bg-gray-200 px-2 py-1', 
                'x-model' => 'product_type',
                    'readonly' => true,
            ])->label('Тип изделия', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'calculation_date')->input('date', [
                'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm bg-gray-200 px-2 py-1', 
                'x-model' => 'calculation_date',
                    'readonly' => true,
            ])->label('Дата расчёта', ['class' => 'block text-[14px]']) ?>

            <?= $form->field($clientModel, 'manager')->dropDownList(
                $managerList, // List of manager options
                [
                    'prompt' => 'Выберите менеджера', // Placeholder option
                    'class' => 'block w-full text-[14px] text-[#172554] border border-gray-300 rounded-sm bg-gray-200 px-2 py-1',
                    'x-model' => 'manager', // Alpine.js binding if needed
                    'value' => $currentUserId, // Set the value to the authenticated user's ID by default
                    'disabled' => true, // This disables the dropdown
                ]
            )->label('Менеджер', ['class' => 'block text-[14px]']); ?>

        </div>   
    </template>                                
</div>