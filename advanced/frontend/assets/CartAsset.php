<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;


class CartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/pages/basket.css',        
        'css/pages/wishlist.css',             
    ];
    public $js = [
        // доп. библиотеки
        //'/js/lib/jquery.min.js',
        //'/js/lib/jquery.imageScroll.min.js',
        // скрипты        
        'js/navbarSwitch.js',
        'js/events-handler.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

