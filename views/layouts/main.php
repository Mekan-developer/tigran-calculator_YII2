<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="bg-gray-100">

    <button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar" type="button" class="inline-flex items-center p-2 mt-2 text-sm text-gray-400 rounded-lg ms-3 sm:hidden hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>


    <aside 
    id="separator-sidebar" 
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-gray-800 rela sm:translate-x-0" 
    aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto ">
            
            <div class="w-full my-4">
                <p class="font-bold text-center text-white">LOGO</p>
                <button
                data-drawer-target="separator-sidebar"
                data-drawer-toggle="separator-sidebar"
                aria-controls="separator-sidebar"
                type="button"
                class="absolute p-1 text-gray-400 rounded-lg top-3 right-3 hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-600"
            >
                <svg
                    class="w-5 h-5"
                    fill="currentColor"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 20 20"
                >
                    <path
                        fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"
                    ></path>
                </svg>
            </button>
            </div>
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="<?= yii\helpers\Url::to(['calculator/index']) ?>" 
                        class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group <?= Yii::$app->controller->id === 'calculator' ? 'bg-gray-700' : '' ?>">
                        <svg aria-hidden="true" data-prefix="far" width="25"  height="25" data-icon="user-chart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-user-chart fa-w-20 fa-7x"><path fill="currentColor" d="M160 320c53.02 0 96-42.98 96-96s-42.98-96-96-96-96 42.98-96 96 42.98 96 96 96zm0-144c26.47 0 48 21.53 48 48s-21.53 48-48 48-48-21.53-48-48 21.53-48 48-48zm66.79 166.02c-9.9 0-19.89 1.45-29.58 4.39-11.79 3.58-24.24 5.6-37.21 5.6s-25.42-2.01-37.21-5.6c-9.68-2.94-19.67-4.39-29.58-4.39-30.23 0-59.65 13.48-76.9 39.11C6.01 396.42 0 414.84 0 434.67V472c0 22.09 17.91 40 40 40h240c22.09 0 40-17.91 40-40v-37.33c0-19.83-6.01-38.25-16.31-53.54-17.25-25.63-46.66-39.11-76.9-39.11zM272 464H48v-29.33c0-9.6 2.81-18.84 8.12-26.74 7.55-11.21 21.41-17.91 37.08-17.91 5.31 0 10.57.78 15.63 2.31C125.59 397.42 142.8 400 160 400s34.41-2.58 51.16-7.67a53.633 53.633 0 0 1 15.63-2.31c15.67 0 29.53 6.7 37.08 17.91 5.31 7.9 8.12 17.14 8.12 26.74V464zM592 0H208c-26.47 0-48 22.25-48 49.59V96c6.44 0 11.4.62 15.8 1.59 5.42.67 10.74 1.52 15.93 2.85 4.17.98 8.17 2.35 12.16 3.78 1.34.49 2.79.74 4.12 1.28V48h384v320h-240v48h240c26.47 0 48-22.25 48-49.59V49.59C640 22.25 618.47 0 592 0zM416.97 256.97l72-72 24.3 24.3c11.34 11.34 30.73 3.31 30.73-12.73V108c0-6.63-5.37-12-12-12h-88.54c-16.04 0-24.07 19.39-12.73 30.73l24.3 24.3L400 206.06l-55.03-55.03c-9.37-9.37-24.57-9.37-33.94 0l-30.73 30.73c4.67 13.29 7.7 27.35 7.7 42.23 0 6.83-.98 13.4-2.01 19.95l42.01-42 55.03 55.03c9.37 9.37 24.57 9.37 33.94 0z" class="flex-shrink-0 text-size-[20px] text-gray-400 transition duration-75 group-hover:text-white"></path></svg>
                        <span class="ms-3">Создать расчётов</span>
                    </a>
                    
                </li>

                
                <li>
                    <a href="<?= yii\helpers\Url::to(['work/index']) ?>" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <i class="fa-solid flex-shrink-0 text-size-[20px] text-gray-400 transition duration-75 group-hover:text-white fa-chart-pie"></i>
                        <span class="ms-3">База расчётов</span>
                    </a>
                    
                </li>

                
                <li>
                        <a href="<?= yii\helpers\Url::to(['currency-rate/index']) ?>" 
                        class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group <?= Yii::$app->controller->id === 'currency-rate' ? 'bg-gray-700' : '' ?>">
                        <i class="fa-solid flex-shrink-0 text-size-[20px] text-gray-400 transition duration-75 group-hover:text-white fa-chart-column"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Курсы валют</span>
                    </a>
                </li>
                
                <li>
                    <a href="<?= yii\helpers\Url::to(['metal-rate/index']) ?>" 
                        class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group <?= Yii::$app->controller->id === 'metal-rate' ? 'bg-gray-700' : '' ?>">
                        <i class="fa-solid flex-shrink-0 text-size-[20px] text-gray-400 transition duration-75 group-hover:text-white fa-chart-line"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Курсы металлов</span>
                    </a>
                </li>
        
                <li>
                    <a href="<?= yii\helpers\Url::to(['metal/index']) ?>" 
                    class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group <?= Yii::$app->controller->id === 'metal' ? 'bg-gray-700' : '' ?>">
                        <i class="fa-solid flex-shrink-0 text-size-[20px] text-gray-400 transition duration-75 group-hover:text-white fa-book-open"></i>
                        <span class="flex-1 ms-3 whitespace-nowrap">Справочник металлов</span>
                    </a>
                </li>

                <li>
                    <a href="<?= Yii::$app->urlManager->createUrl(['stone/index']) ?>" 
                        class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group <?= Yii::$app->controller->id === 'stone' ? 'bg-gray-700' : '' ?>">
                        <i class="fa-solid flex-shrink-0 text-size-[20px] text-gray-400 transition duration-75 group-hover:text-white fa-gem"></i>
                        <span class="ms-3">Справочник камней</span>
                    </a>
                    
                </li>
                
                
                <li>
                    <a href="<?= yii\helpers\Url::to(['work/index']) ?>" 
                        class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group <?= Yii::$app->controller->id === 'work' ? 'bg-gray-700' : '' ?>">
                        <i class="fa-solid flex-shrink-0 text-size-[20px] text-gray-400 transition duration-75 group-hover:text-white fa-file"></i>
                        <span class="ms-3">Справочник работ</span>
                    </a>
                </li>
                
                <li>
                    <a href="#" class="flex items-center p-2 text-white rounded-lg hover:bg-gray-700 group">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-400 transition duration-75 group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                        </svg>
                        <span class="flex-1 ms-3 whitespace-nowrap">Users</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <div class="sm:ml-[250px]">
        <div>
            <?= $content ?>

        </div>
    </div>  


    <!-- Include Flowbite JS from the local web folder -->
    <?= Html::jsFile('@web/js/flowbite.min.js') ?>
    <?= Html::jsFile('@web/js/manual.js') ?>

    <!-- Example: Custom JavaScript to test jQuery -->
    <?php
    $this->registerJs("
        $(document).ready(function() {
            console.log('jQuery is working!');
        });
    ", \yii\web\View::POS_READY);
    ?>
    

</body>
</html>
<?php $this->endPage() ?>
