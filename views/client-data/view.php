<?php
/** @var yii\web\View $this */
/** @var app\models\ClientData $model */

use yii\helpers\Html;

$this->title = 'Детали клиента: ' . Html::encode($clientModel->fio);
?>
<h1 class="text-2xl font-bold mb-2 mt-3 ml-20"><?= Html::encode($this->title) ?></h1>
<div class="flex gap-6 mx-auto pb-10 px-4">
    <div class="flex-1 bg-gray-200 p-4 rounded-sm">
        <div class="p-4 mb-4 bg-blue-100 rounded-sm">
            <h2 class="mb-1 font-semibold text-center  text-black text-md text-[20px]">ДАННЫЕ КЛИЕНТА</h2>
            <table class="min-w-full border-collapse border border-gray-300">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-blue-200 text-blue-900">ФИО</th>
                    <td class="border border-gray-300 px-4 py-2"><?= Html::encode($clientModel->fio) ?></td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-blue-200 text-blue-900">Телефон</th>
                    <td class="border border-gray-300 px-4 py-2"><?= Html::encode($clientModel->phone) ?></td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-blue-200 text-blue-900">Тип изделия</th>
                    <td class="border border-gray-300 px-4 py-2"><?= Html::encode($clientModel->product_type) ?></td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-blue-200 text-blue-900">Дата расчета</th>
                    <td class="border border-gray-300 px-4 py-2"><?= Html::encode($clientModel->calculation_date) ?></td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-blue-200 text-blue-900">Менеджер</th>
                    <td class="border border-gray-300 px-4 py-2"><?= Html::encode($clientModel->manager) ?></td>
                </tr>
            </table>
        </div>

        <div class="p-4 mb-4 bg-pink-100 rounded-sm">
            <h2 class="mb-1 font-semibold text-center  text-black text-md text-[20px]">ДАННЫЕ О МЕТАЛЛЕ</h2>
            <?php if ($metalModel): ?>
                <table class="min-w-full border-collapse border border-gray-300">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-pink-200 text-pink-900">Профиль</th>
                        <td class="border border-gray-300 px-4 py-2"><?= Html::encode($metalModel->profile) ?></td>
                    </tr>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-pink-200 text-pink-900">Высота</th>
                        <td class="border border-gray-300 px-4 py-2"><?= Html::encode($metalModel->height) ?></td>
                    </tr>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-pink-200 text-pink-900">Ширина</th>
                        <td class="border border-gray-300 px-4 py-2"><?= Html::encode($metalModel->width) ?></td>
                    </tr>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-pink-200 text-pink-900">Металл</th>
                        <td class="border border-gray-300 px-4 py-2"><?= Html::encode($metalModel->metal->name ) ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <p class="text-pink-800">Нет данных о металле.</p>
            <?php endif; ?>
        </div>

        <div class="p-4 mb-4 bg-yellow-100 rounded-sm text-[14px]">
            <h2 class="mb-1 font-semibold text-center  text-black text-md text-[20px]">КАМНИ</h2>
            <?php if ($stoneModels): ?>
                <table class="min-w-full border-collapse border  border-gray-300">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-200 text-yellow-900">Камень</th>
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-200 text-yellow-900">Стоимость за 1 шт</th>
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-200 text-yellow-900">Возможный максимум</th>
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-200 text-yellow-900">Кол-во</th>
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-200 text-yellow-900">Стоимость закрепки за 1 шт</th>
                    </tr>
                    <?php foreach ($stoneModels as $stone): ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-nowrap"><?= Html::encode($stone->stone->material).'-'.Html::encode($stone->stone->cut).'-'.Html::encode($stone->stone->diameter).'mm-'.Html::encode($stone->stone->height).'mm' ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($stone->cost_per_unit) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($stone->max_possible) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($stone->quantity) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($stone->setting_cost) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="text-yellow-800">Нет данных о камнях.</p>
            <?php endif; ?>
        </div>

        <div class="p-4 mb-4 bg-green-100 rounded-sm">
            <h2 class="mb-1 font-semibold text-center  text-black text-md text-[20px]">РАБОТЫ</h2>
            <?php if ($workModels): ?>
                <table class="min-w-full border-collapse border border-gray-300">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-green-200 text-green-900">Тип работ</th>
                        <th class="border border-gray-300 px-4 py-2 bg-green-200 text-green-900">Стоимость</th>
                    </tr>
                    <?php foreach ($workModels as $work): ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($work->work->work_name) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($work->cost) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="text-green-800">Нет данных о работах.</p>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="flex-1 bg-gray-200 p-4 rounded-sm">
        <div class="p-4 mb-4 bg-blue-100 rounded-sm">
            <h2 class="mb-1 font-semibold text-center  text-black text-md text-[20px]">ДАННЫЕ КЛИЕНТА</h2>
            <table class="min-w-full border-collapse border border-gray-300">
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-blue-200 text-blue-900">ФИО</th>
                    <td class="border border-gray-300 px-4 py-2"><?= Html::encode($clientModel->fio) ?></td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-blue-200 text-blue-900">Телефон</th>
                    <td class="border border-gray-300 px-4 py-2"><?= Html::encode($clientModel->phone) ?></td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-blue-200 text-blue-900">Тип изделия</th>
                    <td class="border border-gray-300 px-4 py-2"><?= Html::encode($clientModel->product_type) ?></td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-blue-200 text-blue-900">Дата расчета</th>
                    <td class="border border-gray-300 px-4 py-2"><?php echo "СЕГОДНЯ" ?></td>
                </tr>
                <tr>
                    <th class="border border-gray-300 px-4 py-2 bg-blue-200 text-blue-900">Менеджер</th>
                    <td class="border border-gray-300 px-4 py-2"><?= Html::encode($clientModel->manager) ?></td>
                </tr>
            </table>
        </div>

        <div class="p-4 mb-4 bg-pink-100 rounded-sm">
            <h2 class="mb-1 font-semibold text-center  text-black text-md text-[20px]">ДАННЫЕ О МЕТАЛЛЕ</h2>
            <?php if ($metalModel): ?>
                <table class="min-w-full border-collapse border border-gray-300">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-pink-200 text-pink-900">Профиль</th>
                        <td class="border border-gray-300 px-4 py-2"><?= Html::encode($metalModel->profile) ?></td>
                    </tr>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-pink-200 text-pink-900">Высота</th>
                        <td class="border border-gray-300 px-4 py-2"><?= Html::encode($metalModel->height) ?></td>
                    </tr>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-pink-200 text-pink-900">Ширина</th>
                        <td class="border border-gray-300 px-4 py-2"><?= Html::encode($metalModel->width) ?></td>
                    </tr>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-pink-200 text-pink-900">Металл</th>
                        <td class="border border-gray-300 px-4 py-2"><?= Html::encode($metalModel->metal->name ) ?></td>
                    </tr>
                </table>
            <?php else: ?>
                <p class="text-pink-800">Нет данных о металле.</p>
            <?php endif; ?>
        </div>

        <div class="p-4 mb-4 bg-yellow-100 rounded-sm text-[14px]">
            <h2 class="mb-1 font-semibold text-center  text-black text-md text-[20px]">КАМНИ</h2>
            <?php if ($stoneModels): ?>
                <table class="min-w-full border-collapse border  border-gray-300">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-200 text-yellow-900">Камень</th>
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-200 text-yellow-900">Стоимость за 1 шт</th>
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-200 text-yellow-900">Возможный максимум</th>
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-200 text-yellow-900">Кол-во</th>
                        <th class="border border-gray-300 px-4 py-2 bg-yellow-200 text-yellow-900">Стоимость закрепки за 1 шт</th>
                    </tr>
                    <?php foreach ($stoneModels as $stone): ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2 text-nowrap"><?= Html::encode($stone->stone->material).'-'.Html::encode($stone->stone->cut).'-'.Html::encode($stone->stone->diameter).'mm-'.Html::encode($stone->stone->height).'mm' ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($stone->cost_per_unit) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($stone->max_possible) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($stone->quantity) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($stone->setting_cost) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="text-yellow-800">Нет данных о камнях.</p>
            <?php endif; ?>
        </div>

        <div class="p-4 mb-4 bg-green-100 rounded-sm">
            <h2 class="mb-1 font-semibold text-center  text-black text-md text-[20px]">РАБОТЫ</h2>
            <?php if ($workModels): ?>
                <table class="min-w-full border-collapse border border-gray-300">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 bg-green-200 text-green-900">Тип работ</th>
                        <th class="border border-gray-300 px-4 py-2 bg-green-200 text-green-900">Стоимость</th>
                    </tr>
                    <?php foreach ($workModels as $work): ?>
                        <tr>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($work->work->work_name) ?></td>
                            <td class="border border-gray-300 px-4 py-2"><?= Html::encode($work->cost) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p class="text-green-800">Нет данных о работах.</p>
            <?php endif; ?>
        </div>
    </div>
    
</div>


