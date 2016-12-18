<?php
/**
 * Created by PhpStorm.
 * User: Antis
 * Date: 27.11.2016
 * Time: 17:05
 */
/* @var $this yii\web\View */

/* @var $manufacturer \frontend\models\Manufacturer */
/*  models  */

/*  widgets  */
use yii\helpers\Html;
use yii\helpers\Url;

/*  assets  */

use app\assets\PagesAsset;

PagesAsset::register($this);


Yii::setAlias('@imgLogos', '@web/img/catalog/logos');
// TODO: перенести массив $fileNames в базу
$logos = [];
$directoryLogo = Yii::getAlias('@webroot') . '/img/catalog/logos';

if (file_exists($directoryLogo)) {
    $fileNames = array_diff(scandir($directoryLogo), ['..', '.']);
    for ($i = 2; $i < count($fileNames); $i++) {
        $alt = preg_replace("/\.\w+/i", '', $fileNames[$i]);
        //$logos[] = Html::img('@imgLogos/' . $fileNames[$i], ['alt' => "$alt"]);
    }
}
require_once Yii::getAlias('@frontend') . '/views/layouts/manufacturersNames.php';
?>
<div class="wrap wrap-manuf switch" data-swith="manufacturers">
    <div class="row  mobil-width">
        <div class="col-md-4 ">
            <h2 class="manuf-header">Производители</h2>
        </div>
    </div>
    <div class="row  mobil-width">
        <div class="col-md-4 ">

            <?

            echo Html::beginTag('ul', ['class' => 'list']);
            for ($i = 0; $i < count($manufacturer); $i++) {


                echo Html::beginTag('li');
                echo Html::beginTag('a', ['href' => Url::to(['pages/manufacturers_inner', 'name' => $manufacturer[$i]])]);
                echo $manufacturer[$i];
                echo Html::endTag('a');

                echo Html::endTag('li');

            }
            echo Html::endTag('ul');
            ?>
        </div>
        <div class="col-md-8 ">
            <?php
            echo Html::beginTag('ul', ['class' => 'list-company']);
            for ($i = 0; $i < 15/*count($logoNames)*/; $i++) {
                echo Html::beginTag('li', ['class' => 'wrap-resize']);
                echo '<a href="#" class="center-logo ' . $logoNames[$i] . '"></a>';
                echo Html::endTag('li');
            }
            echo Html::endTag('ul');
            ?>
        </div>
    </div>