<?php
/**
 * Created by PhpStorm.
 * User: dmitrij
 * Date: 28.11.2016
 * Time: 14:28
 */

use yii\bootstrap\Dropdown;
use yii\bootstrap\ButtonDropdown;
use yii\bootstrap\Button;

use app\models\Section;

$sections = new Section();

$items = \yii\helpers\ArrayHelper::toArray($sections->getMenu());
//foreach ($sections->getMenu() as $section) {
//    $items[] = $section;
//}
?>
<!---->
<div id="quick-selection" class="wrap-quick-selection">
    <div class="panel-quick-selection">
        <div class="row center-block">
            <div style="display: flex" class="col-sm-12">
                <div class="dropdown category category-2">
                    <button href="#" data-toggle="dropdown" class="dropdown-toggle" ">
                        Выберите категорию
                        <b class="caret"></b>
                    </button>
                    <?php
//                    echo Dropdown::widget([
//                        'items' => $items,
//                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row center-block">
            <div style="display: flex" class="col-sm-12">
                <div class="dropdown category">
                <a href="#" data-toggle="dropdown" class="dropdown-toggle dropdown-toggle-categories">
                <h2 class="section-title"
                    data-id=<?= $products['section']->id ?>><?= $products['section']->title ?></h2>
                </a>
                    <?php
                    echo Dropdown::widget([
                        'items' => $items,
                        'options' => ['class' => 'drop-down-quick-selection']
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row center-block">
            <div class="col-md-12 col-md-offset-0 col-xs-12 col-clear">
                <div class="material">
                    <h5>Материал</h5>
                    <?php
                    echo ButtonDropdown::widget([
                        'options' => ['class' => 'btn-default'],
                        'split' => true,
                        'label' => 'Любой',
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

                        ],

                        'split' => true,
                        'label' => 'Любой',
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
                        'options' => ['class' => 'btn-default'],
                        'split' => true,
                        'label' => 'Любой',
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
                        'options' => ['class' => 'btn-default'],
                        'split' => true,
                        'label' => $items[0]['label'],
                        'dropdown' => [
                            'items' => $items,
                            'clientEvents' => ['click' => 'eventClickDropMenu'],
                        ],
                    ]);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div style="display: flex" class="col-sm-12">
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
</div>
