<?php
   /** @var yii\web\View $this */
    /** @var string $content */
    use rmrevin\yii\fontawesome\FA;
    use yii\helpers\Html;  

    use app\assets\AppAsset;    // Import AppAsset  
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
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="bg-[#2a5298] h-[100vh]">
    <?php $this->beginBody() ?>
       <header class="sticky top-0">
            <div class="flex justify-between items-center h-[60px] bg-[#2a5298] text-white px-4">
                <div class="hidden sm:flex"></div>
                <button data-drawer-target="separator-sidebar" data-drawer-toggle="separator-sidebar" aria-controls="separator-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-white rounded-md ms-3 text-nowrap text-[14px] sm:hidden hover:bg-[#172554] focus:outline-none focus:ring-2 focus:ring-gray-600">
                    <span class="sr-only">Open sidebar</span>
                    <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                    </svg>
                </button>    
                <div class="flex items-center space-x-2">
                    <a href="<?= yii\helpers\Url::to(['user/profile-update', 'id' => Yii::$app->user->identity->id]) ?>">
                        <?php echo FA::icon('user')->fixedWidth()->pullLeft(); ?>
                    </a>
                    <div x-data="{ open: false }" x-init="open = false" class="flex items-center space-x-2 cursor-pointer relative">
                        <!-- Dropdown Toggle -->
                        <div x-on:click="open = !open" class="flex items-center space-x-2 relative">
                            <div>
                                <?= Yii::$app->user->identity->name ?>
                            </div>

                            <span x-show="open">
                                <?php echo FA::icon('angle-up')->fixedWidth()->pullLeft(); ?>
                            </span>
                            <span x-show="!open">
                                <?php echo FA::icon('angle-down')->fixedWidth()->pullLeft(); ?>
                            </span>
                        </div>

                        <!-- Dropdown Menu -->
                        <div x-cloak x-show="open" @click.away="open = false" class="absolute top-[40px] right-0 w-48 bg-white border overflow-hidden border-gray-300 shadow-lg z-10 rounded-md">
                            <div class="">
                                <a href="<?= yii\helpers\Url::to(['user/profile-update', 'id' => Yii::$app->user->identity->id]) ?>" 
                                class="block px-4 py-2 text-sm hover:text-gray-200 text-[#172554] hover:bg-[#5276b9]">
                                    Профиль
                                </a>
                                <a href="<?= yii\helpers\Url::to(['login/logout']) ?>" 
                                class="flex no-underline items-center px-4 py-2 hover:text-gray-200 text-[#172554] hover:bg-[#5276b9]"
                                data-method="post">
                                    <!-- <i class="fa-solid flex-shrink-0 text-size-[20px] text-[#172554] transition duration-75 group-hover:text-white fa-sign-out-alt"></i> -->
                                    <?php echo FA::icon('sign-out-alt')->fixedWidth()->pullLeft(); ?>
                                    <span class="ms-3 text-nowrap text-[14px]">Выйти</span>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </header>

        <aside 
            id="separator-sidebar" 
            class="fixed top-0 left-0  z-40 w-64 rela h-screen transition-transform -translate-x-full bg-[#2a5298]   sm:translate-x-0" 
            aria-label="Sidebar">
            <div class="flex flex-col justify-between items-center h-full py-1">
                <div>
                    <div class="w-full my-4">
                        <p class="font-bold text-center text-white">Тигран - Калькуляторы</p>
                    </div>
                    <ul class="font-medium w-full space-y-2 flex flex-col items-center">
                        <li>
                            <a href="<?= yii\helpers\Url::to(['calculator/index']) ?>" 
                                class="flex no-underline w-[200px] items-center p-2 text-white  rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'calculator' ? 'bg-[#1e3a8a]' : '' ?>">
                                <!-- <svg aria-hidden="true" data-prefix="far" width="25"  height="25" data-icon="user-chart" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="svg-inline--fa fa-user-chart fa-w-20 fa-7x"><path fill="currentColor" d="M160 320c53.02 0 96-42.98 96-96s-42.98-96-96-96-96 42.98-96 96 42.98 96 96 96zm0-144c26.47 0 48 21.53 48 48s-21.53 48-48 48-48-21.53-48-48 21.53-48 48-48zm66.79 166.02c-9.9 0-19.89 1.45-29.58 4.39-11.79 3.58-24.24 5.6-37.21 5.6s-25.42-2.01-37.21-5.6c-9.68-2.94-19.67-4.39-29.58-4.39-30.23 0-59.65 13.48-76.9 39.11C6.01 396.42 0 414.84 0 434.67V472c0 22.09 17.91 40 40 40h240c22.09 0 40-17.91 40-40v-37.33c0-19.83-6.01-38.25-16.31-53.54-17.25-25.63-46.66-39.11-76.9-39.11zM272 464H48v-29.33c0-9.6 2.81-18.84 8.12-26.74 7.55-11.21 21.41-17.91 37.08-17.91 5.31 0 10.57.78 15.63 2.31C125.59 397.42 142.8 400 160 400s34.41-2.58 51.16-7.67a53.633 53.633 0 0 1 15.63-2.31c15.67 0 29.53 6.7 37.08 17.91 5.31 7.9 8.12 17.14 8.12 26.74V464zM592 0H208c-26.47 0-48 22.25-48 49.59V96c6.44 0 11.4.62 15.8 1.59 5.42.67 10.74 1.52 15.93 2.85 4.17.98 8.17 2.35 12.16 3.78 1.34.49 2.79.74 4.12 1.28V48h384v320h-240v48h240c26.47 0 48-22.25 48-49.59V49.59C640 22.25 618.47 0 592 0zM416.97 256.97l72-72 24.3 24.3c11.34 11.34 30.73 3.31 30.73-12.73V108c0-6.63-5.37-12-12-12h-88.54c-16.04 0-24.07 19.39-12.73 30.73l24.3 24.3L400 206.06l-55.03-55.03c-9.37-9.37-24.57-9.37-33.94 0l-30.73 30.73c4.67 13.29 7.7 27.35 7.7 42.23 0 6.83-.98 13.4-2.01 19.95l42.01-42 55.03 55.03c9.37 9.37 24.57 9.37 33.94 0z" class="flex-shrink-0 text-size-[20px] text-white transition duration-75 group-hover:text-white"></path></svg> -->
                                <?php echo FA::icon('calculator')->fixedWidth()->pullLeft(); ?>
                                <span class="ms-3 text-nowrap text-[14px]">Создать расчёт</span>
                            </a>
                            
                        </li>
        
                        
                        <li>
                            <a href="<?= yii\helpers\Url::to(['client-data/index']) ?>" 
                            class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'client-data' ? 'bg-[#1e3a8a]' : '' ?>">
                                <!-- <i class="fa-solid flex-shrink-0 text-size-[20px] text-white transition duration-75 group-hover:text-white fa-chart-pie"></i> -->
                               <?php echo FA::icon('chart-pie')->fixedWidth()->pullLeft();?>
                                <span class="ms-3 text-nowrap text-[14px]">База расчётов</span>
                            </a>
                            
                        </li>
        
                        
                        <li>
                            <a href="<?= yii\helpers\Url::to(['currency-rate/index']) ?>" 
                                class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'currency-rate' ? 'bg-[#1e3a8a]' : '' ?>">
                                <!-- <i class="fa-solid flex-shrink-0 text-size-[20px] text-white transition duration-75 group-hover:text-white fa-chart-column"></i> -->
                                <?php echo FA::icon('chart-bar')->fixedWidth()->pullLeft(); ?>
                                <span class="flex-1 ms-3 text-nowrap text-[14px] whitespace-nowrap">Курсы валют</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?= yii\helpers\Url::to(['metal-rate/index']) ?>" 
                                class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'metal-rate' ? 'bg-[#1e3a8a]' : '' ?>">
                                <!-- <i class="fa-solid flex-shrink-0 text-size-[20px] text-white transition duration-75 group-hover:text-white fa-chart-line"></i> -->
                                <?php echo FA::icon('chart-line')->fixedWidth()->pullLeft();?>
                                <span class="flex-1 ms-3 text-nowrap text-[14px] whitespace-nowrap">Курсы металлов</span>
                            </a>
                        </li>
                
                        <li>
                            <a href="<?= yii\helpers\Url::to(['metal/index']) ?>" 
                            class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'metal' ? 'bg-[#1e3a8a]' : '' ?>">
                                <!-- <i class="fa-solid flex-shrink-0 text-size-[20px] text-white transition duration-75 group-hover:text-white fa-book-open"></i> -->
                                <?php echo FA::icon('book-open')->fixedWidth()->pullLeft();?>
                                <span class="flex-1 ms-3 text-nowrap text-[14px] whitespace-nowrap">Справочник металлов</span>
                            </a>
                        </li>
        
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl(['stone/index']) ?>" 
                                class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'stone' ? 'bg-[#1e3a8a]' : '' ?>">
                                <!-- <i class="fa-solid flex-shrink-0 text-size-[20px] text-white transition duration-75 group-hover:text-white fa-gem"></i> -->
                                <?php echo FA::icon('gem')->fixedWidth()->pullLeft();?>
                                <span class="ms-3 text-nowrap text-[14px]">Справочник камней</span>
                            </a>
                            
                        </li>
                        
                        
                        <li>
                            <a href="<?= yii\helpers\Url::to(['work/index']) ?>" 
                                class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'work' ? 'bg-[#1e3a8a]' : '' ?>">
                                <!-- <i class="fa-solid flex-shrink-0 text-size-[20px] text-white transition duration-75 group-hover:text-white fa-file"></i> -->
                                <?php echo FA::icon('file')->fixedWidth()->pullLeft();?>
                                <span class="ms-3 text-nowrap text-[14px]">Справочник работ</span>
                            </a>
                        </li>
    
                        <?php if (Yii::$app->user->can('admin')){ ?>
                            <li>
                                <a href="<?= yii\helpers\Url::to(['user/index']) ?>" 
                                    class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= (Yii::$app->controller->id === 'user' && Yii::$app->controller->getRoute() != 'user/profile-update') ? 'bg-[#1e3a8a]' : '' ?>">
                                    <!-- <i class="fa-solid fa-users-gear"></i> -->
                                    <?php echo FA::icon('users-cog')->fixedWidth()->pullLeft();?>
                                    <span class="ms-3 text-nowrap text-[14px]">Менеджеры</span>
                                </a>
                            </li>
                        <?php } ?>
        
                    </ul>
                </div>
                

                <div>
                    <a href="<?= yii\helpers\Url::to(['login/logout']) ?>" 
                        class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group"
                        data-method="post">
                        <?php echo FA::icon('sign-out-alt')->fixedWidth()->pullLeft();?>
                        <span class="ms-3 text-nowrap text-[14px]">Выйти </span>
                    </a>              
                </div>

            </div>
        </aside>

        <div class="sm:ml-[270px]  sm:rounded-tl-lg rounded-tl-none bg-white overflow-hidden overflow-y-auto h-[calc(100%-60px)]">
            <div class="">
                <?php include('partials/_alert.php'); ?>        
                <?= $content ?>
            </div>
        </div>     
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
