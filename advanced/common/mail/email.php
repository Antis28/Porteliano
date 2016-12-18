<?php
/**
 * Created by PhpStorm.
 * User: dmitrij
 * Date: 15.12.2016
 * Time: 13:54
 */

use yii\helpers\Html;

if (isset($model)) {
    echo Html::tag('p',$model->name);
    echo Html::tag('p',$model->email);
    echo Html::tag('p',$model->message);
}