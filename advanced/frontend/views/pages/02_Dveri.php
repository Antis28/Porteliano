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
use app\assets\DoorsAsset;

DoorsAsset::register($this);

Yii::setAlias('@doors', '@web/img/02/');

$this->params['breadcrumbs'][] = [
    'label' => 'Двери',
    'url' => Url::to(['site/index', '#' => 'doors']),
    'template' => "<li> {link} </li>\n", // template for this link only

];
$coverTitles = ['деревянные', 'Стеклянные', 'Радиусные', 'Двери со стеклом', 'Металлические двери', 'деревянные двери'];
$sectionUrls = [
    [],
    ['/catalog',
        'section' => '3',
        'material' => '1',

    ],
    ['/catalog',
        'section' => '3',
        'material' => '5',

    ],
    ['/catalog',
        'section' => '3',
        'style' => '4',

    ],
    ['/catalog',
        'section' => '4',
        'material' => '2',

    ],
    ['/catalog',
        'section' => '3',
        'material' => '1',

    ],
    ['/catalog',
        'section' => '5',


    ],
    [],
    [],
];
$bottomHead = 'Элитные итальянские двери, межкомнатные и входные';
$bottomContent_1 = 'Архитектура, живопись, дизайн интерьера, мебель и, наконец, двери — Италия по праву носит титул страны, в которой рождается модерн, со временем переходящий в классику. Компания "Porteliano" работает для того, чтобы Вы могли перенести итальянскую традицию в Ваш дом или офис.';
$bottomContent_2 = 'Речь идет о входных конструкциях непревзойденного качества и восхитительного дизайна, которые мы готовы предложить нашим покупателям. Благодаря большому количеству компаний-производителей, с которыми у нас давно налажено тесное сотрудничество, Вы можете выбирать двери итальянские из широчайшего ассортимента.';
?>

<div class="wrap switch" data-swith='doors'>
    <div class="wrap-tiles doors-wrap">
        <div class="doors-panel">
            <div class="row center-block">
                <div class="col-md-10  col-xs-12">
                    <?= Html::tag('h2', 'Межкомнатные двери'); ?>
                </div>
            </div>
            <div class="row ">
                <?php
                for ($i = 1; $i < 5; $i++) {
                    echo '<div class="col-md-3 plate-inn-doors">';
                    echo Html::beginTag('a', ['href' => Url::to($sectionUrls[$i])]);
                    echo Html::img("@doors/inner_0$i.jpg",
                        ['alt' => "door_0$i", 'class' => 'tile']);
                    echo '<div class="doors-gradient doors-inn-gradient-pos"></div>
                        <h2 class="center-block">' . $coverTitles[$i - 1] . '</h2>';
                    echo Html::endTag('a');
                    echo '</div>';
                }
                ?>
            </div>
            <div class="row center-block">
                <div class="col-md-10 ">
                    <?= Html::tag('h2', 'Входные двери'); ?>
                </div>
            </div>
            <div class="row ">
                <?php
                for ($i = 1; $i < 3; $i++) {
                    echo '<div class="col-md-6 plate-out-doors">';
                    echo Html::beginTag('a', ['href' => Url::to($sectionUrls[$i + 3]), 'class' => 'cover-plate']);
                    echo Html::img("@doors/outer_0$i.jpg",
                        ['alt' => "door_0$i", 'class' => 'tile']);
                    echo '<div class="doors-gradient doors-out-gradient-pos"></div>
                        <h2 class="center-block">' . $coverTitles[$i + 3] . '</h2>';
                    echo Html::endTag('a');
                    echo '</div>';
                }
                ?>
            </div>
            <div class="row center-block">
                <div class="col-md-10 ">
                    <?= Html::tag('h2', 'Ручки') ?>
                </div>
            </div>
            <div class="row ">

                <div class="col-md-6 wrap-doors-tiles plate">
                    <?= Html::beginTag('a', ['href' => Url::to(['/catalog', 'section' => '5']), 'class' => 'grip-wrap']); ?>
                    <?= Html::img("@doors/grips.jpg",
                        ['alt' => "door_0$i", 'class' => 'tile']); ?>

                    <div class="doors-gradient grips-gradient-pos"></div>
                    <h2 class="center-block">для межкомнатных дверей</h2>
                    <?= Html::endTag('a'); ?>
                </div>

            </div>
        </div>

        <div class="row desk-center-block">
            <div class="col-md-10 ">
                <?= Html::tag('h4', $bottomHead); ?>
                <?= Html::tag('p', $bottomContent_1); ?>
                <?= Html::tag('p', $bottomContent_2); ?>
            </div>
        </div>

    </div>
</div>

