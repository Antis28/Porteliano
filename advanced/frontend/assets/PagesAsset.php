<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;


class PagesAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [        
        'css/pages/doors.css',
        'css/pages/doors-catalog.css',
        'css/pages/septa.css',
        'css/pages/manuf.css',
        'css/pages/manuf-inner.css',
        'css/pages/about.css',
        'css/pages/delivery.css',
        'css/pages/contacts.css',
        'css/logo_sprites_all.css',
    ];
    public $js = [
        // доп. библиотеки
        //'/js/lib/jquery.min.js',
        //'/js/lib/jquery.imageScroll.min.js',
        // скрипты
        'js/parallax.js',
        'js/navbarSwitch.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

