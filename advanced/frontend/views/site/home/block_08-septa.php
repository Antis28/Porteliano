<?php
/*
 * Блок с фильтром быстрого подбора:
 */

/*  models  */

/*  widgets  */
use yii\helpers\Html;
use yii\helpers\Url;

/*  assets  */
use app\assets\BackAsset;

BackAsset::register($this);
// псевдоним пути к папке на основе другого псевдонима
Yii::setAlias('@septa', '@web/img/septa');

// TODO заменить на загрузку из базы
$category = ['Входная дверь'];
$doorData_2 = ['Bauxt', 'Bauxt', 'Security', 'Bauxt'];
$doorData_3 = ['Export 1106', 'Export 1136', 'SECURITY', 'Elite 1115'];
$price = ['1545', '1545', '2119', '2194'];

// массив для заполнения информационных полей под плитками новинок


//echo Html::img('@septa/septa_'.$i.'.jpg',
?>
<article id="septa" class="wrap-septa" data-item="a3">
    <div class="row">
        <div class="col-md-offset-1 col-md-10">
            <h2 class="septa-h2">Перегородки</h2>
        </div>
    </div>
    <!-- Вкладки -->
    <div class="row">
        <!-- кнопка назад -->
        <div class="col-md-1 flex-vert-centr show">
            <button id="prev"  class="btn btn-link prev" data-param="prev" onclick="nextDownload(event, true, 1)"></button>
        </div>
        <!-- Перегородки -->
        <div class="col-md-10 novelty-folders">
            <div id="doors-inn" class="doors-panel running-ribbon-septa">
                <div class="wrap-tiles view">
                    <ul class="ribbon-ul" data-section="2">
                        <?php if (isset($septum['products'])): ?>
                            <?php foreach ($septum['products'] as $product): ?>

                                <?php require Yii::getAlias('@frontend') . "/views/layouts/ribbonElement.php"; ?>

                            <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
        <!-- кнопка вперед -->
        <div class="col-md-1 show">
            <button id="next" class="btn btn-link next" data-param="next" onclick="nextDownload(event, false, 1)"></button>
        </div>
    </div>
    
    <!-- Кнопка -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <a href="<?= Url::to(['pages/septa']); ?>" class="btn btn-default btn-lg septa-show-more" role="button" >
                ПОКАЗАТЬ БОЛЬШЕ</a>
        </div>
    </div>
    <div class="arrow"></div>
</article>


