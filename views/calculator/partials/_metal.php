<!-- Dynamic Rows -->
<template x-for="(item, index) in itemsMetal" :key="index">
    <div class="p-4 mb-4 bg-pink-100 rounded-sm flex-1">
        <h2 class="mb-1 font-semibold text-pink-800 text-md">МЕТАЛЛ</h2>

        <label :for="'profile' + index" class="text-[14px]">Профиль</label>
        <input type="text" x-model="item.profile" :id="'profile' + index" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500 px-2 py-1" placeholder="Профиль">

        <label :for="'height' + index" class="text-[14px]">Высота</label>
        <input type="text" x-model="item.height" :id="'height' + index" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500 px-2 py-1" placeholder="Высота">

        <label :for="'width' + index" class="text-[14px]">Ширина</label>
        <input type="text" x-model="item.width" :id="'width' + index" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500 px-2 py-1" placeholder="Ширина">

        <label :for="'ring_size' + index" class="text-[14px]">Размер кольца</label>
        <input type="text" x-model="item.ring_size" :id="'ring_size' + index" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500 px-2 py-1" placeholder="Размер кольца">

        <label :for="'metal_id' + index" class="text-[14px]">Металл</label>
        <select x-model="item.metal_id" :id="'metal_id' + index" class="block w-full text-[14px] border border-gray-300 rounded-sm px-2 py-1">
            <option value="">Выберите металл</option>
            <?php foreach (\yii\helpers\ArrayHelper::map(app\models\Metal::find()->all(), 'id', 'name') as $id => $name): ?>
                <option :value="<?= $id ?>"><?= $name ?></option>
            <?php endforeach; ?>
        </select>

        <label :for="'tolerance' + index" class="text-[14px]">Погрешность, %</label>
        <input type="text" x-model="item.tolerance" :id="'tolerance' + index" class="block w-full text-[14px] border border-gray-300 rounded-sm focus:ring-pink-500 focus:border-pink-500 px-2 py-1" placeholder="Погрешность, %">
    </div>
</template>
<!-- Hidden Field for JSON -->
<input type="hidden" name="itemsMetal" :value="JSON.stringify(itemsMetal)">