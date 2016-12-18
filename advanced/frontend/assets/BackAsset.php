<?php
/**
 * Created by PhpStorm.
 * User: dmitrij
 * Date: 24.11.2016
 * Time: 12:58
 */

namespace app\assets;


use yii\web\AssetBundle;

class BackAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        '/js/jquery-ui.min.css'
    ];
    public $js = ['js/events-handler.js',
        '/js/jquery-ui.min.js',
        'js/ajax-modal-popup.js'
    ];
}