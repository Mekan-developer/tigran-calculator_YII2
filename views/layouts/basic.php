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
                    <div x-data="{ open: false }" x-init="open = false" class="relative flex items-center space-x-2 cursor-pointer">
                        <!-- Dropdown Toggle -->
                        <div x-on:click="open = !open" class="relative flex items-center space-x-2">
                            <div>
                                <?= Yii::$app->user->identity->name ?>
                            </div>

                            <span x-show="open">
                                <i class="fa fa-angle-up"></i>
                            </span>
                            <span x-show="!open">
                                <i class="fa fa-angle-down"></i>
                            </span>
                        </div>

                        <!-- Dropdown Menu -->
                        <div x-cloak x-show="open" @click.away="open = false" class="absolute top-[40px] right-0 w-48 bg-white border overflow-hidden border-gray-300 shadow-lg z-50 rounded-md">
                            <div class="">
                                <a href="<?= yii\helpers\Url::to(['user/profile-update', 'id' => Yii::$app->user->identity->id]) ?>" 
                                class="block px-4 py-2 text-sm hover:text-gray-200 text-[#172554] hover:bg-[#5276b9]">
                                    Профиль
                                </a>
                                <a href="<?= yii\helpers\Url::to(['login/logout']) ?>" 
                                class="flex no-underline items-center px-4 py-2 hover:text-gray-200 text-[#172554] hover:bg-[#5276b9]"
                                data-method="post">
                                    <i class="fa fa-sign-out-alt"></i>
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
            <div class="flex flex-col items-center justify-between h-full py-1">
                <div>
                    <div class="w-full my-4">
                        <p class="font-bold text-center text-white">Тигран - Калькуляторы</p>
                    </div>
                    <ul class="flex flex-col items-center w-full space-y-2 font-medium">
                        <li>
                            <a href="<?= yii\helpers\Url::to(['calculator/index']) ?>" 
                                class="flex no-underline w-[200px] items-center p-2 text-white  rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'calculator' ? 'bg-[#1e3a8a]' : '' ?>">
                                <i class="fa fa-calculator"></i>
                                <span class="ms-3 text-nowrap text-[14px]">Создать расчёт</span>
                            </a>
                        </li>
        
                        
                        <li>
                            <a href="<?= yii\helpers\Url::to(['client-data/index']) ?>" 
                            class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'client-data' ? 'bg-[#1e3a8a]' : '' ?>">
                               <i class="fa fa-chart-pie"></i>
                                <span class="ms-3 text-nowrap text-[14px]">База расчётов</span>
                            </a>
                        </li>
        
                        
                        <li>
                            <a href="<?= yii\helpers\Url::to(['currency-rate/index']) ?>" 
                                class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'currency-rate' ? 'bg-[#1e3a8a]' : '' ?>">
                                <i class="fa fa-chart-bar"></i>
                                <span class="flex-1 ms-3 text-nowrap text-[14px] whitespace-nowrap">Курсы валют</span>
                            </a>
                        </li>
                        
                        <li>
                            <a href="<?= yii\helpers\Url::to(['metal-rate/index']) ?>" 
                                class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'metal-rate' ? 'bg-[#1e3a8a]' : '' ?>">
                                <i class="fa fa-chart-line"></i>
                                <span class="flex-1 ms-3 text-nowrap text-[14px] whitespace-nowrap">Курсы металлов</span>
                            </a>
                        </li>
                
                        <li>
                            <a href="<?= yii\helpers\Url::to(['metal/index']) ?>" 
                            class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'metal' ? 'bg-[#1e3a8a]' : '' ?>">
                                <i class="fa fa-book-open"></i>
                                <span class="flex-1 ms-3 text-nowrap text-[14px] whitespace-nowrap">Справочник металлов</span>
                            </a>
                        </li>
        
                        <li>
                            <a href="<?= Yii::$app->urlManager->createUrl(['stone/index']) ?>" 
                                class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'stone' ? 'bg-[#1e3a8a]' : '' ?>">
                                <i class="fa fa-gem"></i>
                                <span class="ms-3 text-nowrap text-[14px]">Справочник камней</span>
                            </a>
                        </li>
                        
                        
                        <li>
                            <a href="<?= yii\helpers\Url::to(['work/index']) ?>" 
                                class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= Yii::$app->controller->id === 'work' ? 'bg-[#1e3a8a]' : '' ?>">
                                <i class="fa fa-file"></i>
                                <span class="ms-3 text-nowrap text-[14px]">Справочник работ</span>
                            </a>
                        </li>
    
                        <?php if (Yii::$app->user->can('admin')){ ?>
                            <li>
                                <a href="<?= yii\helpers\Url::to(['user/index']) ?>" 
                                    class="flex no-underline w-[200px] items-center p-2 text-white rounded-md hover:bg-[#172554] group <?= (Yii::$app->controller->id === 'user' && Yii::$app->controller->getRoute() != 'user/profile-update') ? 'bg-[#1e3a8a]' : '' ?>">
                                    <i class="fa fa-users-cog"></i>
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
                        <i class="fa fa-sign-out-alt"></i>
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
