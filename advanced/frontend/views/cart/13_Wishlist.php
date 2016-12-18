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

use app\assets\BasketAsset;
$countGoods = '2 товара';
BasketAsset::register($this);
Yii::setAlias('@img', '@web/img/');

?>
<div class="wrap-wishlist">
    <!-- заголовок -->
    <div class="row">
        <div class="col-md-2 col-md-offset-3 ">
            <h1>Избранное</h1>
        </div>
        <div class="col-md-2 col-md-offset-3 ">
            <h4 id="count-goods"><span id="counter-goods">
                    <?= $wish->getQuantity() ?> </span><span class="word-product"> товара</span></h4>
        </div>
    </div>
    <!-- товары -->
    <? if ($wish->getQuantity() === 0): ?>

        <H2>Список избранного пуст!</H2>


    <?php else: ?>
    <?php  foreach($wish->get() as $id => $item): ?>
    <?php if (((int)($id) > 0 ) && $item['quantity'] > 0 ): ?>

    <div class="row goods-row">
        <!-- иконка -->
        <div class="col-md-1 col-md-offset-3 ">
            <?= Html::img($item['product']->image,
                ['class' => 'door-icon', 'alt' => "door icon"]) ?>
        </div>
        <!-- описание и удаление -->
        <div class="col-md-4">
            <!-- описание -->
            <div class="row">
                <div class="col-md-12">
                    <span class="description">
                        <?= $item['product']->title ?>
                    </span>
                </div>
            </div>
            <!-- удаление -->
            <div class="row">
                <div class="col-md-12">
                    <a class="delete" href="#"
                       onclick="delItem(event, 'wish', <?= $item['product']->id ?> )" >Удалить
                    </a>
                </div>
            </div>
        </div>
        <!-- кнопка в корзину -->
        <div class="col-md-1 button-area">
            <a href="#" onclick="addToCart(event)">
                <span
                    class="glyphicon glyphicon-shopping-cart btn btn-default basket-button"
                    role="button"
                ></span>
            </a>
        </div>
    </div>
        <?php endif; ?>
    <?php endforeach; ?>
    <!-- разделитель -->
    <div class="row">
        <div class="col-md-6 col-md-offset-3 ">
            <hr/>
        </div>
    </div>
    <?php endif; ?>
</div>


