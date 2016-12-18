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

<div class="contact-form">
    <div class="row">

        <article class="col-lg-12">
            <h2 class="contact-form-header-all">Остались вопросы?</h2>
            <p class=".contact-form-text">Отправьте нам сообщение, и мы свяжемся
                с вами в ближайшее время</p>
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

            <?= $form->field($questionForm, 'email',
                [
                    'horizontalCssClasses' => [
                        'wrapper' => 'col-sm-2',
                    ],
                    'template' => '{input}{error}'
                ]
            )->textInput(['placeholder' => 'E-mail']); ?>

            <?= $form->field($questionForm, 'messge',
                [
                    'horizontalCssClasses' => [
                        'wrapper' => 'col-sm-2',
                    ],
                    'template' => '{input}{error}'
                ]
            )->textarea(['placeholder' => 'Сообщение', 'rows' => 3]); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                    <?= Html::submitButton('ОТПРАВИТЬ ЗАЯВКУ', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>