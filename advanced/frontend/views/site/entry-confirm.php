<?php
use yii\helpers\Html;

Yii::$app->view->registerMetaTag([
    'http-equiv' => 'Refresh',
    'content' => '3; url=/'
]);
?>
<p>Спасибо, <?= Html::encode($model->name) ?></p>

