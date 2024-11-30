<?php
/**
 * @link https://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license https://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/flowbite.min.css',
        'css/tailwind.css',
        'fontsAwesome/css/all.min.css',
        // 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css',
        'https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css'
    ];
    public $js = [
        'js/flowbite.min.js',
        'js/alpine.js'
    ];
    public $depends = [
        '\rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
