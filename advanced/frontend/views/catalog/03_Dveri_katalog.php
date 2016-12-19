<?php
/**
 * Created by PhpStorm.
 * User: Antis
 * Date: 27.11.2016
 * Time: 21:04
 */
/** @var string $ind */
/*  models  */

/*  widgets  */
use app\models\Section;
use yii\bootstrap\Button;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Dropdown;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;

/*  assets  */
/*  assets  */

use app\assets\FontAsset;
use app\assets\BackAsset;
use app\assets\DoorCatalogAsset;
use app\assets\MainAdaptiveAsset;

FontAsset::register($this);
MainAdaptiveAsset::register($this);
BackAsset::register($this);

DoorCatalogAsset::register($this);
// псевдоним пути к папке
Yii::setAlias('@imgLogos', '@web/img/catalog/logos');
Yii::setAlias('@doors', '@web/img/02/');
Yii::setAlias('@doors', '@web/img/doors');
Yii::setAlias('@cover', '@web/img/cover');

// определение какие обложки и заголовки показывать
switch ($products['section']->id) {
    case 3:
        $categoryTitle = 'Межкомнатные двери';

        $coverImgLeft = '@cover/outer.jpg';
        $coverImgRight = '@cover/grips.png';


        $coverTextLeft = 'Входные двери';
        $coverTextRight = 'Ручки';

        $coverLinkLeft = Url::to(['catalog/', 'section' => '4']);
        $coverLinkRight = Url::to(['catalog/', 'section' => '5']);
        break;
    case 2:
        $categoryTitle = 'Перегородки';

        $coverImgLeft = '@cover/outer.jpg';
        $coverImgRight = '@cover/grips.png';


        $coverTextLeft = 'Входные двери';
        $coverTextRight = 'Ручки';

        $coverLinkLeft = Url::to(['catalog/', 'section' => '4']);
        $coverLinkRight = Url::to(['catalog/', 'section' => '5']);
        break;
    case 4:
        $categoryTitle = 'Входные двери';

        $coverImgLeft = '@cover/grips.png';
        $coverImgRight = '@cover/inner.png';

        $coverTextLeft = 'Ручки';
        $coverTextRight = 'Межкомнатные двери';

        $coverLinkLeft = Url::to(['catalog/', 'section' => '5']);
        $coverLinkRight = Url::to(['catalog/', 'section' => '3']);
        break;
    case 5:
        $categoryTitle = 'Ручки';

        $coverImgLeft = '@cover/outer.jpg';
        $coverImgRight = '@cover/inner.png';

        $coverTextLeft = 'Входные двери';
        $coverTextRight = 'Межкомнатные двери';

        $coverLinkLeft = Url::to(['catalog/', 'section' => '4']);
        $coverLinkRight = Url::to(['catalog/', 'section' => '3']);
        break;
    default:
        $categoryTitle = 'нет категории';
        $coverImgLeft = '@cover/outer.jpg';
        $coverImgRight = '@cover/inner.png';

        $coverTextLeft = 'Входные двери';
        $coverTextRight = 'Межкомнатные двери';

        $coverLinkLeft = Url::to(['catalog/', 'section' => '4']);
        $coverLinkRight = Url::to(['catalog/', 'section' => '3']);
}

$this->params['breadcrumbs'][] = [
    'label' => 'Двери ',
    'url' => Url::to(['pages/dveri']),
    'template' => "<li><ins>{link}</ins></li>\n", // template for this link only
];

$this->params['breadcrumbs'][] =[
    'label' => $categoryTitle,    //'Межкомнтаные двери ',
    'url' => Url::to(['catalog/']),
    'template' => "<li> {link} </li>\n",
];

$sections = new Section();
$items = [];
$title = $categoryTitle;//$products['section']['title'];
foreach ($sections->getMenu() as $section) {
    $items[] = $section;
}

// TODO заменить на загрузку из базы
    $category = ['Входная дверь'];
    $doorData_2 = ['Bauxt', 'Bauxt', 'Security', 'Bauxt'];
    $doorData_3 = ['Export 1106', 'Export 1136', 'SECURITY', 'Elite 1115'];
    $price = ['1545', '1545', '2119', '2194'];
// массив для заполнения информационных полей под плитками новинок


?>
<div class="door-catalog">
    <div class="panel-quick-selection">
        <!-- заголовок -->
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-title" data-id="<?= $ind ?>">
                    <?= $sections->findOne($ind)->title_main ?>
                </h2>
            </div>
        </div>
        <!-- панель выбора -->
        <div class="row">
            <div class="col-lg-12 ">
                <div class="flex-container">
                    <div class="material">
                        <h5>Вид</h5>
                        <?php
                        echo ButtonDropdown::widget([
                            'options' => ['class' => 'btn-default',
                                'data-id' => (isset($params['material'])) ? $params['material'] : null],
                            'split' => true,
                            'label' => (isset($params['material']))
                                ? $products['materials'][$params['material']]['label']
                                : 'Любой',
                            'dropdown' => [
                                'items' =>

                                    $products['materials']
                                ,
                                'clientEvents' => ['click' => 'eventClickDropMenu'],

                            ],
                        ]);
                        ?>
                    </div>
                    <div class="style">
                        <h5>Стиль</h5>
                        <?php
                        echo ButtonDropdown::widget([
                            'options' => [
                                'class' => 'btn-default',
                                'data-id' => (isset($params['style'])) ? $params['style'] : null
                            ],

                            'split' => true,
                            'label' => (isset($params['style']))
                                ? $products['styles'][$params['style']]['label']
                                : 'Любой',
                            'dropdown' => [
                                'items' => $products['styles'],
                                'clientEvents' => ['click' => 'eventClickDropMenu'],
                            ],

                        ]);
                        ?>
                    </div>
                    <div class="manufacturer">
                        <h5>Производитель</h5>
                        <?php
                        echo ButtonDropdown::widget([
                            'options' => ['class' => 'btn-default',
                                'data-id' => (isset($params['manufacturer'])) ? $params['manufacturer'] : null
                            ],
                            'split' => true,
                            'label' => (isset($params['manufacturer']))
                                ? $products['manufacturers'][$params['manufacturer']]['label']
                                : 'Любой',
                            'dropdown' => [
                                'items' => $products['manufacturers'],
                                'clientEvents' => ['click' => 'eventClickDropMenu'],
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="block-1-price">
                        <h5>Цена</h5>
                        <?php
                        $items = [
                            ['label' => 'Любые', 'url' => '#',
                                'linkOptions'=> ['data-toggle' =>'dropdown','data-id' => '0']],
                            ['label' => 'до 500 €', 'url' => '#',
                                'linkOptions'=> ['data-toggle' =>'dropdown','data-id' => '1']],
                            ['label' => '500 - 1000 €', 'url' => '#',
                                'linkOptions'=> ['data-toggle' =>'dropdown','data-id' => '2']],
                            ['label' => '1000 - 2000 €', 'url' => '#',
                                'linkOptions'=> ['data-toggle' =>'dropdown','data-id' => '3']],
                            ['label' => 'от 2000 €', 'url' => '#',
                                'linkOptions'=> ['data-toggle' =>'dropdown','data-id' => '4']],
                        ];
                        echo ButtonDropdown::widget([
                            'options' => ['class' => 'btn-default',
                                'data-id' => (isset($params['price'])) ? $params['price'] : null
                            ],
                            'split' => true,
                            'label' => (isset($params['price'])) ? $items[$params['price']]['label'] : $items[0]['label'],
                            'dropdown' => [
                                'items' => $items,
                                'clientEvents' => ['click' => 'eventClickDropMenu'],
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="pick-up">
                        <?php
                        echo Button::widget([
                            'label' => 'ПОДОБРАТЬ',
                            'options' => ['class' => 'btn-default'],
                            'clientEvents' => ['click' => 'eventClickSelectButton'],
                        ]);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- методы сортировки -->
        <div class="row">
            <div class="col-md-5">
                <span>Сортировать по:</span>
                <span class="btn btn-link"><?=Html::a('Алфавиту',Url::to(array_merge(['catalog/'], $params, ['order' => 'abc']))) ?></span>
                <span class="btn btn-link"><?=Html::a('Цена',Url::to(array_merge(['catalog/'], $params, ['order' => '012']))) ?></span>
            </div>
        </div>
        <!-- контейнер для выбранных дверей -->
        <div class="row">
            <div class="col-md-12">
                <div class="sampling-area catalog-elements" data-section="<?= $ind ?>">

                    <?php foreach ($products['products'] as $product): ?>

                        <?php require Yii::getAlias('@frontend') . "/views/layouts/ribbonElement.php"; ?>

                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- кнопка показать ещё -->
        <div class="row give-more">
            <div class="col-md-12">
                <a href="#" onclick="nextDownload(event, false,20)">
                    <div class="center-flex">
                        <div class="glyphicon glyphicon-plus-sign"></div>
                        <div class="">Показать ещё</div>
                    </div>
                </a>
            </div>
        </div>
        <!-- Обложки на соседние категории -->
        <div class="row">
            <div class="col-md-6">
                <div class="plate">
                    <a href="<?=$coverLinkLeft?>">
                        <?= Html::img($coverImgLeft, [
                            'style' => 'width: 100%',
                        ]) ?>

                        <div class="doors-gradient doors-gradient-pos"></div>
                        <h2 class="center-block"><?=$coverTextLeft?></h2>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-xs-12">
                <div class="plate">
                    <a href="<?=$coverLinkRight?>">
                        <?= Html::img($coverImgRight, [
                            'style' => 'width: 100%',
                        ]) ?>
                        <div class="doors-gradient doors-gradient-pos"></div>
                        <h2 ><?=$coverTextRight?></h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
