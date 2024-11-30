<?php
   /** @var yii\web\View $this */
    /** @var string $content */

    use yii\helpers\Html;
    use app\assets\LoginAsset; 
    LoginAsset::register($this);


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
<body class="bg-gray-100">
    <?php $this->beginBody() ?>


    <div class="snow relative">
        <div class="absolute w-full h-full z-[99999]">
            <?php include('partials/_alert.php'); ?>
             <?= $content ?>
        </div>
    </div>


    <!-- <div class="sm:ml-[250px]">
        <div>
                    
           
        </div>
    </div>      -->
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>