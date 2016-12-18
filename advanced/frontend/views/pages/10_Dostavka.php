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
use yii\bootstrap\Collapse;
use yii\helpers\Html;
use yii\helpers\Url;

/*  assets  */
use app\assets\PagesAsset;
PagesAsset::register($this);

use app\assets\FontAsset;
FontAsset::register($this);

Yii::setAlias('@img', '@web/img/');
Yii::setAlias('@imgBigLogos', '@web/img/catalog/logos/big');
// в хлебные крошки 2 ссылки
$this->params['breadcrumbs'][] = [
    'label' => 'О компании',
    'url' => Url::to(['pages/about']),
    'template' => "<li><ins>{link}</ins></li>\n", // template for this link only
];

$this->params['breadcrumbs'][] = [
    'label' => 'Доставка',
    'url' => Url::to(['pages/about_dostavka']),
    'template' => "<li> {link} </li>\n", // template for this link only

];

// для заолнения таблиц в metering
function TypesJobs($arr)
{
    /** @var array $arr */
    $str = '';
    for ($i = 0; $i < count($arr[0]); $i++) {
        $str .= '<tr>';
        for ($j = 0; $j <= count($arr)-1; $j++) {
            if($j > 0){
                $str .= "<td><strong>" . $arr[$j][$i] . "</strong></td>";
            }else {
                $str .= "<td>" . $arr[$j][$i] . "</td>";
            }
        }
        $str .= '</tr>';
    }
    return $str;
}


$costLifting = [
    [
        'Двери и перегородки в разборе (h до 225 см) (за шт.)',
        'Двери в сборе (h до 225 см)',
        'Двери в сборе (h выше 225 см)',
        'Двери в разборе (h выше 225 см)',
        'Перегородки (h выше 225 см) (за полотно)',
        'Перегородки HEADLINE (h выше 225 см) (за полотно).',
        'Балка с рельсонаправляющей (за шт.)',
        'Металлические двери (cм. п.9) (за шт.)',
        'Серия «Pininfarina» TR, Oicos, Bauxt и сложные конструкции (за шт.)',

    ],
    [
        '300 <span class="currency">a</span>',
        '400 <span class="currency">a</span>',
        '500 <span class="currency">a</span>',
        '400 <span class="currency">a</span>',
        '350 <span class="currency">a</span>',
        '450 <span class="currency">a</span>',
        '-',
        '1000 <span class="currency">a</span>',
        '1500 <span class="currency">a</span>',

    ],
    [
        '250 <span class="currency">a</span>',
        '300 <span class="currency">a</span>',
        '350 <span class="currency">a</span>',
        '300 <span class="currency">a</span>',
        '350 <span class="currency">a</span>',
        '450 <span class="currency">a</span>',
        '100 <span class="currency">a</span>',
        '500 <span class="currency">a</span>',
        '750 <span class="currency">a</span>',
    ],
    [
        '250 <span class="currency">a</span>',
        '300 <span class="currency">a</span>',
        '350 <span class="currency">a</span>',
        '300 <span class="currency">a</span>',
        '350 <span class="currency">a</span>',
        '450 <span class="currency">a</span>',
        '-',
        '1000 <span class="currency">a</span>',
        '1500 <span class="currency">a</span>',
    ],
];
$doors = [
    [
        'Установка одностворчатой двери (без добора)',
        'Установка двустворчатой двери (без добора)',
        'Установка одностворчатой двери выше 225 см (по проёму)',
        'Установка двустворчатой двери выше 225 см (по проёму)',
        'Установка фальшкоробки (lualdi/ longi)',
        'Установка добора на 1-ств. дверь',
        'Установка добора на 2-ств. дверь',
        'Установка добора на 1-ств. дверь выше 225 см',
        'Установка добора на 2-ств. дверь выше 225 см',
        'Установка капители с одной стороны',
        'Установка декоративных элементов (составляющих наличник) с одной стороны',
    ],
    [
        '105 €',
        '165 €',
        '165 €',
        '330 €',
        '-',
        '45 €',
        '60 €',
        '90 €',
        '120 €',
        '25 €',
        '25 €',
    ],
    [
        '90 €',
        '180 €',
        '150 €',
        '300 €',
        '50 €',
        '60 €',
        '90 €',
        '90 €',
        '120 €',
        '25 €',
        '25 €',
    ],
];
//Перегородки
$septa = [
    [
        '<p>Установка перегородки сложной конструкции;</p>
                1 и 2 ств. купе в стену, включая мет каркас, если он входит в заказ',
        'Установка 1-ств. купе по стене',
        'Установка 2-ств. купе по стене',
        'Установка металлического каркаса для 1-ств. (отдельно)',
        'Установка металлического каркаса для 2-ств.(отдельно)',
        'Установка металлического каркаса для 1-ств. (нестандарт по высоте)',
        'Установка металлического каркаса для 2-ств.(нестандарт по высоте)',
        'Установка книжки (2-х полотной и 4-х полотной)',


    ],
    [
        '15 %',
        '165 €',
        '330 €',
        '105 €',
        '210 €',
        '160 €',
        '320 €',
        '15 %',
    ],
    [
        '15 %',
        '15 %',
        '15 %',
        '150 €',
        '210 €',
        '160 €',
        '320 €',
        '15 %',
    ],
];
//Обрамление проёма
$framingAperture = [
    [
        'Установка прямоугольного обрамления проёма — стандарт',
        'Установка прямоугольного обрамления проёма — нестандарт',
        'Установка арочного обрамления проёма — стандарт',
        'Установка арочного обрамления проёма — нестандарт',
        'Установка добора на обрамление проема',
    ],
    [
        '75 €',
        '90 €',
        '-',
        '-',
        '30 €',
    ],
    [
        '90 €',
        '105 €',
        '150 €',
        '180 €',
        '90 €',
    ],
];
//Фрамуга
$Transom = [
    [
        'Установка прямоугольной фрамуги — стандарт',
        'Установка прямоугольной фрамуги — нестандарт (2х створчатая)',
        'Установка арочной фрамуги — стандарт',
        'Установка арочной фрамуги — нестандарт (2х створчатая)',
        'Установка добора на фрамугу',

    ],
    [
        '90 €',
        '105 €',
        '105 €',
        '-',
        '60 €',
    ],
    [
        '90 €',
        '150 €',
        '150 €',
        '180',
        '90 €',
    ]
];
$jobsMetalDoors = [
    [
        'Монтаж/замена панели при установке входной двери',
        'Демонтаж старой панели',
        'Монтаж/замена панели',
        'Монтаж/замена панели на дверь клиента (куплен не в «А.И.»)',
        'Замена блока MIA/личинки — Dierre, Nucleo — Torterolo',
        'Установка одностворчатой металлической двери (в готовый проем)',
        'Установка двустворчатой металлической двери (в готовый проем)',
        'Установка всей серии Pininfarina, все двери со стеклом',
    ],
    [
        '-',
        '-',
        '-',
        '70 €',
        '105 €',
        '-',
        '-',
        '-',
    ],
    [
        '30 €',
        '15 €',
        '60 €',
        '70 €',
        '105 €',
        '225 €',
        '375 €',
        '450 €',
    ]
];
$additionalWork = [
    [
        '<p>Подрезка двери по высоте (полотно + коробка)</p>
            см. бланк на подрезку',
        'Замена стекла на 1 створку',
        '<p>Изготовление добора вдоль – 1 комплект:</p>
          - Сложный, с фрезеровкой паза и шипа',
        '- Простой (АР, Бараус)',
        'Подгонка вдоль 1 наличника с одной стороны.',
        'Установка ручек, купленных не в «АИ»',
        'Наклейка ТОР.',
        'Вызов мастера на консультацию',
        'Демонтаж деревянной двери',
        'Демонтаж перегородки',
        'Демонтаж и навеска полотна перегородки',
        '<p>Подрезка подгонка коробки и полотна снизу под горизонталь пола</p>
        для неровного пола',
        'Упаковка двери в полиэтиленовый пакет клиента или в сущ-ую коробку',
        'Расширение проёма на усмотрение мастера (стена только кирпич или пеноблок)',
        'Ремонт филёнок по вине клиента',
        'Сборка корпусной мебели',
        '<p>Регулировочные работы м/к дверей (петли, фурнитура) за каждое полотно</p>
        + выезд',
        'Ложный вызов',
        '<p>Стоимость и возможность увеличения проёмов силами мастеров определяется</p>
        по месту',
        'Монтаж лестниц',
    ],
    [
        '40 € орех',
        '45 € белые',
        '60 €',
        '60 €',
        '30 €',
        '15 €',
        '10 €',
        '10 €',
        '100 €',
        '40 €',
        '70 €',
        '8 %',
        '50 €',
        '40 €',
        '-',
        '10 €',
        '78 €',
        '50 €',
        '9 %',
        '25 €',
        '30 €',
        '-',
        '25 %',

    ],
    [
        '',
        '75 €',
        '75 €',
        '60 €',
        '30 €',
        '15 €',
        '10 €',
        '-',
        '10 €',
        '40 €',
        '70 €',
        '8 %',
        '50 €',
        '40 €',
        '50 €',
        '10 €',
        '75 €',
        '50 €',
        '9 %',
        '25 €',
        '30 €',
        '-',
        '25 %',
    ]
];


$lifting = '
<div class="row">
    <div class="col-md-12">
    <table class="table table-hover lifting-costs">
        <tr class="table-headers m-2-header">
            <td></td>
            <td>В грузовом лифте, за дверь</td>
            <td>На руках, за дверь, за этаж</td>
            <td>Частный дом, коттедж, 1 шт.</td>
        </tr>
        <tr class="table-headers m-1-header">
            <td>Двери, перегородки, входные двери</td>
            <td></td>
            <td></td>            
        </tr>
        ' . TypesJobs($costLifting) . '
    </table>
    </div>
</div>
';
$metering = '
<div class="row">
    <div class="row">
        <div class="col-md-12 zamer">
            <p>Замер проема под межкомнатную дверь: <strong>5 €</strong></p>
            <p>Замер под межкомнатную перегородку или замер входной двери: <strong>10 €</strong></p>
        </div>
    </div>
    <div class="col-md-12">
        <table class="table table-hover metering">
            <tr >
                <td>
                    <h2 class="table-headers">Виды работ</h2>
                    <span>(цена рассчитывается исходя из стоимости единицы товара без учета скидки)</span>
                </td>
                <td class="table-headers table-other">Barrausse и Lualdi</td>
                <td class="table-headers table-other">Другие
                    фабрики</td>
            </tr>
            <tr class="table-headers">
                <td>Двери</td>
                <td></td>
                <td></td>                
            </tr>
            ' . TypesJobs($doors) . '
            <!--**********************************************************-->
            <tr class="table-headers">
                <td>Перегородки</td>
                <td></td>
                <td></td>                
            </tr>
            ' . TypesJobs($septa) . '
            <!--**********************************************************-->
            <tr class="table-headers">
                <td>Обрамление проёма</td>
                <td></td>
                <td></td>                
            </tr>
           ' . TypesJobs($framingAperture) . '
            <!--**********************************************************-->
            <tr class="table-headers">
                <td>Фрамуга</td>
                <td></td>
                <td></td>                
            </tr>
            ' . TypesJobs($Transom) . '
            <tr class="table-headers">
                <td>Металлические двери</td>
                <td></td>
                <td></td>                
            </tr>
            ' . TypesJobs($jobsMetalDoors) . '
            <tr class="table-headers">
                <td>Дополнительные работы</td>
                <td></td>
                <td></td>                
            </tr>
            ' . TypesJobs($additionalWork) . '
        </table>
    </div>
</div>
';


?>


<div class="wrap-delivery">

    <div class="limited-content">
        <div class="delivery center-block">
            <!-- заголовок -->
            <div class="row center-block">
                <div class="col-md-12 .col-sm-12 col-xs-12 clear-indent">
                    <h1 class="delivery-header">Доставка и установка</h1>
                </div>
            </div>
            <!-- подзаголовок -->
            <div class="row center-block ">
                <div class="col-md-12 .col-sm-12 col-xs-12 clear-indent">
                    <h2 class="delivery-cost">Стоимость доставки</h2>
                </div>
            </div>
            <!-- колонка цен и колонка внимание-->
            <div class="row center-block">
                <div class="col-md-4 col-sm-4 col-xs-12 clear-indent">
                    <table class="table table-responsive table-hover">
                        <caption><h3 class="mark-header">По Москве</h3></caption>
                        <tbody>
                        <tr>
                            <td>до 5 км от МКАД</td>
                            <td>3000 <span class="currency">a</span></td>
                        </tr>
                        <tr>
                            <td>от 5-15 км от МКАД</td>
                            <td>3200 <span class="currency">a</span></td>
                        </tr>
                        <tr>
                            <td>от 15-30 км от МКАД</td>
                            <td>3500 <span class="currency">a</span></td>
                        </tr>
                        <tr>
                            <td>от 30-70 км от МКАД</td>
                            <td>3500 <span class="currency">a</span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- колонка внимание  -->
                <div class="col-md-8  .col-sm-2 col-xs-12 clear-indent">
                    <h3 class="mark-header"> Внимание!</h3>
                    <p>
                        Если по техническим причинам доставить товар «в квартиру» нет возможности, то по согласованию с
                        клиентом товар доставляется «до подъезда» или отвозится обратно на склад компании "Porteliano".
                        В этом случае, повторная доставка оплачивается клиентом дополнительно. Экстремальные виды услуг по
                        подъёму компания не оказывает.
                    </p>
                </div>

            </div>
        </div>
        <!-- collapse -->
        <div class="row center-block collapse-wrap ">
            <div class="col-md-12 clear-indent">
                <?php
                echo Collapse::widget([
                    'items' => [
                        [
                            'label' => 'Стоимость подъёма',
                            'content' => $lifting,
                            'options' => ['class' => 'lifting-costs-head'],
                            // Открыто по-умолчанию
                            'contentOptions' => [
                                'class' => ' panel-lifting-costs'//in
                            ]

                        ],
                        [
                            'label' => 'Стоимость замеров и установки',
                            'content' => $metering,
                            'contentOptions' => [
                                'class' => ' panel-metering-costs'
                            ],
                            'options' => ['class' => 'metering-costs-head'],
                        ],
                    ]
                ]);
                ?>
            </div>
        </div>
    </div>
    <!--
        <div class="action-push"></div>
         parallax -->
    <div class="row center-block">
        <div class="col-md-12">
            <div class="action consultation">
                <div class="img-holder"
                     data-image="<?= Yii::getAlias('@web') . '/img/background/FOTO_INTRO_01.jpg' ?>">
                </div>
                <div class="row">
                    <div class="action-text">
                        <article class="col-md-12 col-xs-12 ">
                            <h1 class="consultation-header">Воспользуйтесь бесплатной консультацией</h1>
                            
                        </article>
                                                 
                            <p class="consultation-text">
                                Заполните поля ниже, и наш менеджер свяжется с Вами, чтобы проконсультироватьпо Вашим индивидуальным вопросам.
                            </p>
                        
                        <div class="col-md-12 col-xs-12">
                            <? require 'consultation-form.php' ?>
                        </div>
                    </div>

                </div>
                <script src="/js/lib/jquery.min.js"></script>
                <script src="/js/lib/jquery.imageScroll.min.js"></script>
                <script>
                    $('div.action > .img-holder').imageScroll({
                        holderClass: 'imageHolder',
                        container: $('div.action'),
                        speed: 0.1,
                        coverRatio: 0.75,
                        mediaWidth: 2000,
                        mediaHeight: 1014,
                        holderMaxHeight: 1000,
                        holderMinHeight: 866,
                        parallax: true,
                        touch: false
                    });
                    $(function () {
                        $('.panel-heading > .panel-title > a').on("click", function() {

                            $('div.action > .img-holder').imageScroll('refresh');
                            var content = $('html');
                            $('div.action > .img-holder').trigger('scroll');

                            console.log( $( this ).text() );


                        });
                    })
                </script>
            </div>
        </div>
    </div>

</div>

