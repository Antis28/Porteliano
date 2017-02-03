<?php
/**
 * Created by PhpStorm.
 * User: dmitrij
 * Date: 02.12.2016
 * Time: 12:02
 */
/** @var frontend\models\Product $products */
use yii\helpers\Html;
use yii\helpers\Url;


?>

<?php
    echo Html::beginTag('div', ['class' => 'tile', 'data-id' => $product->id]);

    echo Html::a(

        Html::img($product->image,
        ['alt' => $product->title, 'class' => 'tile-img']), '/catalog/product/?id='. $product->id,
        ['class' => 'link-tile']);

    //заполняется карточка
    echo Html::beginTag('div', ['class' => 'info']);
    echo Html::beginTag('div', ['class' => 'info-text']);
    echo Html::tag('p', $product->section->title_product);
    echo Html::tag('p', (isset($product->manufacturer)) ? $product->manufacturer->title : '');
    echo Html::tag('p', $product->title);
    echo Html::endTag('div');
    echo Html::tag('div', '', ['class' => 'delimiter']);
    echo Html::beginTag('div', ['class' => 'block-4-price']);
    $price = $product->prices;
    echo
    Html::tag('div',
        ((count($price)) ? current($price)->currency->title : '')
            . ' '. ((count($price) > 0) ?
                current($price)->cost
                : ''),
        ['class' => 'block-price-count add-to-cart',
            'data-id' => $product->id]
    );
    echo Html::a(
        Html::tag('div', '', [
            'class' => 'glyphicon add-to-wish '. ((isset($wish) && $wish->isWished($product->id))
                ? ' glyphicon-heart ' : ' glyphicon-heart-empty '),
            'data-id' => $product->id]),

        Url::to(['cart/addWish', 'id' => $product->id,]), ['onclick' => 'addToWish()']);

    echo Html::endTag('div');
    echo Html::endTag('div');
    echo Html::endTag('div');

?>
