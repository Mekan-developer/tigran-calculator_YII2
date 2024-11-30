<!-- Dynamic Rows -->
<template x-for="(item, index) in itemsMetal" :key="index">
    <div class="p-4 mb-4 bg-[#96add4] flex-1 text-white">
        <h2 class="mb-1 font-semibold text-md">МЕТАЛЛ</h2>

        <label :for="'profile' + index" class="text-[14px]">Профиль</label>
        <input type="text" x-model="item.profile" :id="'profile' + index" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Профиль">

        <label :for="'height' + index" class="text-[14px]">Высота</label>
        <input type="text" x-model="item.height" :id="'height' + index" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Высота">

        <label :for="'width' + index" class="text-[14px]">Ширина</label>
        <input type="text" x-model="item.width" :id="'width' + index" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Ширина">

        <!-- <label :for="'ring_size' + index" class="text-[14px]">Размер кольца</label>
        <input type="text" x-model="item.ring_size" :id="'ring_size' + index" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Размер кольца"> -->

        <?php 
            $sizes = [ '14','14.25','14.5','14.75', '15','15.25','15.5','15.75','16','16.25','16.5','16.75','17','17.25','17.5','17.75','18','18.25','18.5','18.75','19','19.25','19.5','19.75','20','20.25','20.5','20.75','21','21.25','21.5','21.75','22','22.25','22.5','22.75','23','23.25','23.5','23.75','24'];
        ?>
        <label :for="'metal_id' + index" class="text-[14px]">Размер кольца</label>
        <select x-model="item.ring_size" :id="'ring_size' + index" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1">
            <option value="">Выберите размер кольца</option>
            <?php foreach ($sizes as $size): ?>
                <option :value="<?= $size ?>"><?= $size ?></option>
            <?php endforeach; ?>
        </select>


        <label :for="'metal_id' + index" class="text-[14px]">Металл</label>
        <select x-model="item.metal_id" :id="'metal_id' + index" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1">
            <option value="">Выберите металл</option>
            <?php foreach (\yii\helpers\ArrayHelper::map(app\models\Metal::find()->all(), 'id', 'name') as $id => $name): ?>
                <option :value="<?= $id ?>"><?= $name ?></option>
            <?php endforeach; ?>
        </select>

        <label :for="'tolerance' + index" class="text-[14px]">Скругление, %</label>
        <input type="number" min="0" max="100" x-model="item.rounding" :id="'tolerance' + index" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Скругление, %" >

        <label :for="'tolerance' + index" class="text-[14px]">Погрешность, %</label>
        <input type="number" x-model="item.tolerance" :id="'tolerance' + index" class="block w-full text-[14px] text-black border border-gray-300 rounded-sm px-2 py-1" placeholder="Погрешность, %">
    </div>
</template>
<!-- Hidden Field for JSON -->
<input type="hidden" name="itemsMetal" :value="JSON.stringify(itemsMetal)">