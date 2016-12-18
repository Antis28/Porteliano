<?php
/**
 * Created by PhpStorm.
 * User: Antis
 * Date: 27.11.2016
 * Time: 17:05
 */
/* @var $this yii\web\View */
/*  models  */

/*  widgets  */
use yii\helpers\Html;
use yii\helpers\Url;

/*  assets  */
use app\assets\PagesAsset;

PagesAsset::register($this);
Yii::setAlias('@img', '@web/img/');
Yii::setAlias('@imgBigLogos', '@web/img/catalog/logos/big');
?>
<div class="wrap-contacts switch" data-swith="contact">

    <div class="row-contact">
        <div class="row center-block">
            <div class="col-md-6 .col-sm-4 padding-clear">
                <h2>Контакты</h2>
                <div class="row orange">
                    <div class="col-md-12 .col-sm-12 col-xs-12">
                        Единый телефон (многоканальный):
                    </div>
                </div>
                <div class="row indent">
                    <div class="col-md-12 .col-sm-12 col-xs-12">
                        +7 (495) 742-17-24
                    </div>
                </div>
                <div class="row orange">
                    <div class="col-md-12 .col-sm-12 col-xs-12">
                        Телефон:
                    </div>
                </div>
                <div class="row indent">
                    <div class="col-md-12 .col-sm-12 col-xs-12">
                        +7 (495) 123-65-56
                    </div>
                </div>
                <div class="row orange">
                    <div class="col-md-12 .col-sm-12 col-xs-12">
                        Адрес:
                    </div>
                </div>
                <div class="row ">
                    <div class="col-md-12 .col-sm-12 col-xs-12">
                        Москва, 3-й Донской проезд, дом 1,
                    </div>
                </div>
                <div class="row indent">
                    <div class="col-md-12 .col-sm-12 col-xs-12">
                        м.Ленинский проспект
                    </div>
                </div>
                <div class="row orange">
                    <div class="col-md-12 .col-sm-12 col-xs-12">
                        E-mail:
                    </div>
                </div>
                <div class="row indent">
                    <div class="col-md-12 .col-sm-12 col-xs-12">
                        absolute@ak-in.ru
                    </div>
                </div>
            </div>
            <div class="col-md-2  .col-sm-2 col-xs-2">
                <div class="contact-img">
                </div>
            </div>
        </div>
    </div>
    <div class="map">

        <script type="text/javascript" charset="utf-8" async
                src="https://api-maps.yandex.ru/services/constructor/1.0/js/?sid=-zt7pyu1ot07ORrKltN3hhhNxShJKgs-&amp;width=-1&amp;height=800&amp;lang=ru_RU&amp;sourceType=constructor&amp;scroll=true">
        </script>
        <div class="forma">
            <?// require Yii::getAlias('@frontend') . '/views/site/home/contact-form.php' ?>
            <? require Yii::getAlias('@frontend') . '/views/pages/contact-question-form.php' ?>
        </div>
        <script>
            /*
            $(function () {
                $('.ymaps-2-1-45-ground-pane').css({
                    'top'   : '-150px',
                    'left'  : '0px',
                    'position': 'absolute',
                    'z-index'   : '701'

                });
            });
            */
        </script>
    </div>
</div>


