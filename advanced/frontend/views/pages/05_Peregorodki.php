<?php
/**
 * Created by PhpStorm.
 * User: Antis
 * Date: 27.11.2016
 * Time: 17:05
 */

/*  models  */

/*  widgets  */
use yii\helpers\Html;
use yii\helpers\Url;

/*  assets  */
use app\assets\SeptaAsset;

SeptaAsset::register($this);

Yii::setAlias('@septa', '@web/img/05/');

$this->params['breadcrumbs'][] = [
    'label' => 'Перегородки ',
    'url' => Url::to(['catalog/', 'section' => '2']),
    'template' => "<li> {link} </li>\n", // template for this link only

];

$bottomHead = 'Раздвижные двери и межкомнатные перегородки – функциональные решения для планировки пространств';
$bottomContent_1 = 'Не забывая об эстетической привлекательности, многие люди стремятся рационально использовать пространство своего дома, и межкомнатные двери являются отличным функциональным решением такой задачи. Такие конструкции сегодня пользуются особой популярностью и поэтому в нашем каталоге представлены самые разнообразные межкомнатные перегородки из различных материалов и раздвижные двери от итальянских производителей.';
$bottomContent_2 = 'Именно они позволят значительно сэкономить место в жилом или рабочем помещении, которое никогда не бывает лишним, а еще одно их достоинство — легкость и бесшумность открывания. Выполненные из дерева, металла и стекла, раздвижные конструкции также имеют оригинальный дизайн, поэтому итальянские межкомнатные двери и перегородки из нашего ассортимента Вы сможете использовать в интерьере любого стиля — от классики и ретро до этники и хай-тека.';
?>
<div class="wrap septa switch" data-swith='septa'>
    <div class="septa-container">
        <div class="wrap-tiles">
            <!-- Заголовок -->
            <div class="row mobil-width center-block">
                <div class="col-md-10 col-md-offset-1 clear-indent">
                    <?= Html::tag('h2', 'Раздвижные перегородки',['class' => 'septa-header']); ?>
                </div>
            </div>
            <!-- плитки -->
            <div class="row mobil-width center-block">
                <div class="col-md-11 col-md-offset-1 clear-indent">
                    <div class="plate plate-m-1">
                        <?= Html::beginTag('a', ['href' =>  Url::to(['catalog/', 'section' => '2'])]); ?>
                        <?= Html::img("@septa/septa_01.jpg",

                            ['alt' => "Межкомнатные перегородки", 'class' => 'tile']); ?>
                        <div class="gradient gradient-pos"></div>
                        <h2 class="center-block cover-text">Межкомнатные</h2>

                        <?= Html::endTag('a'); ?>
                    </div>
                    <div class="plate plate-m-3">
                        <?= Html::beginTag('a', ['href' =>  Url::to(['catalog/', 'section' => '2', 'material' => '5']),]); ?>
                        <?= Html::img("@septa/septa_02.jpg",

                            ['alt' => "Стеклянные перегородки", 'class' => 'tile']); ?>
                        <div class="gradient gradient-pos"></div>
                        <h2 class="center-block cover-text">Стеклянные</h2>
                        <?= Html::endTag('a'); ?>
                    </div>
                    <div class="plate plate-m-2">
                        <?= Html::beginTag('a', ['href' =>  Url::to(['catalog/', 'section' => '2', 'style' => '4']),]); ?>
                        <?= Html::img("@septa/septa_03.jpg",
                            ['alt' => "Радиусные перегородки", 'class' => 'tile']); ?>
                        <div class="gradient gradient-pos"></div>
                        <h2 class="center-block cover-text">Радиусные</h2>

                        <?= Html::endTag('a'); ?>
                    </div>
                </div>
            </div>
            <div class="row center-block bottom-text">
                <div class="col-md-10 col-md-offset-1">
                    <?= Html::tag('h4', $bottomHead); ?>
                    <?= Html::tag('p', $bottomContent_1); ?>
                    <?= Html::tag('p', $bottomContent_2); ?>
                </div>
            </div>

        </div>
    </div>
</div>
<script>
    $('.navbar li > a[data-target]').removeClass('lightButton');
    $('.navbar li > a[data-target=a3]').addClass('lightButton');
</script>