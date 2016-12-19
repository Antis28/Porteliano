<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;


class MainPageAdaptiveAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/main/block_1.css',
        'css/main/block_2.css',
		'css/main/block_3.css',
        'css/main/block_4.css',
        'css/main/block_5.css',
        'css/main/block_6.css',
        'css/main/block_7.css',
        'css/main/block_8.css',
        'css/main/block_9.css',
        'css/main/block_10.css',
        'css/main/block_11.css',
        'css/main/block_12.css',
        'css/door_card.css',
        'css/logo_sprites_all.css',
        'css/main/main_page_mobile.css',
    ];
    public $js = [
        // доп. библиотеки
        '/js/lib/jquery.min.js',
        '/js/lib/jquery.imageScroll.min.js',
        '/js/lib/jquery.scroolly.js',
        //'/js/lib/jquery.fontawesome.js', // для иконок

        // скрипты
        'js/runningRibbon.js',
        'js/scrollingDoors.js',

        'js/ajax-modal-popup.js',
        'js/fixedMenu.js',
        'js/scrollspy.js',
        'js/parallax.js',
/*
        */
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

