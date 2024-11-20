<!-- Second Div -->
<div x-data="{
        fio: $parent.fio,
        phone: $parent.phone,
        product_type: $parent.product_type,
        calculation_date: $parent.calculation_date,
        manager: $parent.manager
    }" class="mb-4 bg-blue-100 rounded-sm">

    <h2 class="mb-1 font-semibold text-blue-800 text-md">ДАННЫЕ КЛИЕНТА</h2>

    <label for="fio" class="block w-full text-[14px]">ФИО</label>
    <input type="text" id="fio" 
        class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100" 
        x-model="fio" readonly />

    <label for="phone" class="block w-full text-[14px]">Телефон</label>
    <input type="text" id="phone" 
        class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500 bg-gray-100" 
        x-model="phone" readonly />

    <label for="product_type" class="block w-full text-[14px]">Тип изделия</label>
    <input 
        type="text" 
        id="product_type" 
        class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" 
        x-model="product_type"
    />

    <label for="calculation_date" class="block w-full text-[14px]">Дата расчёта</label>
    <input 
        type="date" 
        id="calculation_date" 
        class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" 
        x-model="calculation_date"
    />

    <label for="manager" class="block w-full text-[14px]">Менеджер</label>
    <input type="text" id="manager" 
        class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-blue-500 focus:border-blue-500" 
        x-model="manager" />

</div> 