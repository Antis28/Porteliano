<?php
/**
 * Created by PhpStorm.
 * User: Antis
 * Date: 27.11.2016
 * Time: 1:29
 */
/* @var @questionForm \frontend\models\QuestionForm */

/*  models  */
use  frontend\models\QuestionForm;
/*  widgets  */
use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap\ActiveForm;
?>

<div class="contact-form  contact-form-back-call">
    <div class="contact-form-panel">
        <div class="row">
            <article class="col-lg-12">
                <h2 class="contact-form-header">Контакты</h2>
                <div class="contact-form-city">м. Проспект</div>
                <div class="contact-form-str">Арбатская улица 1</div>
                <div class="contact-form-phone">+5(555) 555-55-55,  +5(555) 555-55-55</div>
                <div class="contact-form-mail">mail@mail.ru</div>
                <hr style="
                    border: none; /* Убираем границу для браузера Firefox */
                    color: #9a2434; /* Цвет линии для остальных браузеров */
                    background-color:#9a2434; /* Цвет линии для браузера Firefox и Opera */
                    height: 2px; /* Толщина линии */
                   "/>
            </article>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'fieldConfig' => [
                        'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",

                        'horizontalCssClasses' => [
                            'label' => 'col-sm-4',
                            'offset' => 'col-sm-offset-4',
                            'wrapper' => 'col-sm-8',
                            'error' => '',
                            'hint' => '',
                        ],

                    ],
                    'options' => ['class' => 'form-horizontal'],
                ]); ?>
                <?= $form->field($questionForm, 'username',
                    [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-sm-2',
                        ],
                        'template' => '{input}{error}'
                    ]
                )->textInput(['placeholder' => 'Ваше имя']); ?>


                <?= $form->field($questionForm, 'phone',
                    [
                        'horizontalCssClasses' => [
                            'wrapper' => 'col-sm-2',
                        ],
                        'template' => '{input}{error}'
                    ]
                )->textInput(['placeholder' => 'Телефонный номер']); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <?= Html::submitButton('ЗАКАЗАТЬ ОБРАТНЫЙ ЗВОНОК', ['class' => 'btn btn-primary']) ?>
                </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>        
    </div>
    

</div>