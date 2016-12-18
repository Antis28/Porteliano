<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;


class MainPageAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = [
        'css/animation.css',
        'css/gray.css',        
        'css/main.css',
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
        
    ];
    public $js = [
        // доп. библиотеки
        //'http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js',
        '/js/lib/jquery.scroolly.js',
        // скрипты
        'js/ajax-modal-popup.js',
        'js/runningRibbon.js',
        'js/fixedMenu.js',
        'js/scrollspy.js',
        'js/parallax.js',
        'js/scrollingDoors.js'
    ];
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

