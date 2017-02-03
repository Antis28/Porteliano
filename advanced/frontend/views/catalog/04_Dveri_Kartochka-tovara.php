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

/*  assets  */
use app\assets\pages\ProductAsset;
use app\assets\FontAsset;

ProductAsset::register($this);
FontAsset::register($this);

// псевдоним пути к папке
Yii::setAlias('@doors', '@web/img/doors');
Yii::setAlias('@cover', '@web/img/cover');

// определение какие обложки и заголовки показывать
switch ($product->section->id) {
    case 3:
        $categoryTitle = 'Межкомнатные двери';

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
        $coverImgRight = '@cover/grips.png';

        $coverTextLeft = 'Входные двери';
        $coverTextRight = 'Ручки';

        $coverLinkLeft = Url::to(['catalog/', 'section' => '4']);
        $coverLinkRight = Url::to(['catalog/', 'section' => '5']);
}

// в хлебные крошки 2 ссылки
$this->params['breadcrumbs'][] = [
    'label' => 'Двери ',
    'url' => Url::to(['/catalog','section' => '1']),
    'template' => "<li><ins>{link}</ins></li>\n", // template for this link only
];

$this->params['breadcrumbs'][] = [
    'label' => $categoryTitle,    //'Межкомнтаные двери ',
    'url' => Url::to(['/catalog','section' => '3']),
    'template' => "<li> {link} </li>\n",
];

$sections = new Section();
$items = [];
// $title для теста берется из indx
$title = $categoryTitle;//$products['section']['title'];
unset($categoryTitle);
foreach ($sections->getMenu() as $section) {
    $items[] = $section;
}



?>
<div class="door-catalog door-cart">
    <div class="panel-quick-selection">
        <!--карточка-->
        <div class="row door-card-info">
            <div class="col-md-5 ">
                <?= Html::img($product->image, ['class'=> 'doorImg']) ?>
            </div>
            <div class="product-discript-door col-md-7 ">
                <div class="row ">
                    <div class="col-md-10 col-xs-11 door-title">
                        <h1 class="product-title"><?= (isset($product->section)) ? $product->section->title_product . ' ' .
                                $product->title : '' ?></h1>
                    </div>
                </div>
                <!--Производитель-->
                <div class="row ">
                    <div class="col-md-6 col-xs-6">
                        <h4 class="product-discript">Производитель</h4>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <h4 ><?= (isset($product->manufacturer)) ? $product->manufacturer->title : '' ?></h4>
                    </div>
                </div>
                <!--Коллекция-->
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <h4 class="product-discript">Коллекция</h4>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <h4><?= $product->collection  ?></h4>
                    </div>
                </div>
                <!--Артикул-->
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <h4 class="product-discript">Артикул</h4>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <h4><?= $product->article  ?></h4>
                    </div>
                </div>
                <!--Стиль-->
                <div class="row">
                    <div class="col-md-6 col-xs-6">
                        <h4 class="product-discript">Стиль</h4>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <h4><?= (isset($product->style)) ? $product->style->title : '' ?></h4>
                    </div>
                </div>
                <!----------->
                <div class="row">
                    <div class="col-md-9  col-xs-9">
                        <h5 class="product-note"><?=$product->note  ?></h5>
                        <hr class="hr-separation"/>
                    </div>
                </div>
                <!--Стоимость-->
                <div class="row">
                    <div class="col-md-6  col-xs-6">
                        <h4 class="product-discript product-price-h">Стоимость</h4>
                    </div>
                    <div class="col-md-6  col-xs-6">
                        <h4 class="product-price"><?= (isset($product->price))
                                ? $product->price->cost.' '.$product->price->currency->title : '' ?></h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-9  col-xs-9">
                        <hr class="hr-separation"/>
                    </div>
                </div>
                <div class="row buttons-area">
                    <div class="col-md-6  col-xs-6">
                        <a  href="#" class="add-basket-link">
<!--                            TODO перекрасить кнопку по функции $product->isOrdered() -->
                <span id="in-basket" class="btn btn-default send-button"
                      role="button" data-id="<?= $product->id ?>" onclick=addToCart(event)>
                    <?= ($product->isOrdered()) ? 'Товар уже в корзине' : 'ДОБАВИТЬ В КОРЗИНУ'  ?>
                </span>
                        </a>
                    </div>
                    <div class="col-md-6 col-xs-6">
                        <a id="in-wishlist" class="btn btn-default" href="#"
                           data-id="<?= $product->id ?>" onclick=addToWish()>
                <span class="glyphicon glyphicon-heart<?= ($product->isWished()) ? '' : '-empty' ?>"
                      data-id="<?= $product->id ?>" ></span>
                        </a>
                    </div>
                </div> <!--Добавить в корзину-->
            </div>
        </div>
        <!--Обложки на соседние категории-->
        <div class="row cover-all">
            <div class="col-md-6 col-xs-12 top-cover">
                <div class="plate center-block">
                    <a href="<?=$coverLinkLeft?>">
                        <?= Html::img($coverImgLeft, [
                            'class'=>'img-border'
                        ]) ?>

                        <div class="doors-gradient doors-gradient-pos"></div>
                        <h2 class="center-block"><?= $coverTextLeft ?></h2>
                    </a>
                </div>
            </div>
            <div class="col-md-6 col-xs-12 bottom-cover">
                <div class="plate center-block">
                    <a href="<?=$coverLinkRight?>">
                        <?= Html::img($coverImgRight, [
                            'class'=>'img-border'
                        ]) ?>
                        <div class="doors-gradient doors-gradient-pos"></div>
                        <h2><?= $coverTextRight ?></h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
