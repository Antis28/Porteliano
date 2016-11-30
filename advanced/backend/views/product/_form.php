<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/formdata']
    ]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?php echo $form->field($model, 'section_id')->dropDownList($model->getSections());   ?>

    <?= $form->field($model, 'material_id')->dropDownList($model->getMaterials()) ?>

    <?= $form->field($model, 'style_id')->dropDownList($model->getStyles()) ?>

    <?= $form->field($model, 'manufacturer_id')->dropDownList($model->getManufacturers()) ?>


    <?php
    //echo $form->field($model, 'imageFile')->fileInput();
//    $widget = \kartik\file\FileInput::widget();
//    $widget

//    echo $form->field($model, 'img')->widget(\kartik\file\FileInput::className(),
//        [
//            'options' => ['accept' => '@frontend/web/img/*',],
//            'model' => $model,
//            'pluginOptions' => [
//                'initialCaption'=> $model->img,
//                'initialPreviewConfig' => [
//                    ['caption' => $model->img, ],],
//                'initialPreview'=>[
//                    "<img src = '/img/".$model->manufacturer->title.'/'.$model->img."' class='prev'>",
//                ],
//            ]
//        ]);
    echo $form->field($model, 'img')->textInput(['maxlength' => true])
    ?>

    <?php

        $previews = [];
    $previewConf = [];
        foreach ($model->files as $id => $file){

            $previews[$id] = "<img src = '/img/".$model->manufacturer->title.'/'.$file->file."' class='prev'>";
            $previewConf[$id] = ['caption' => $file->file,];
    }
        echo $form->field($model, 'upload_files[]')->widget(\kartik\file\FileInput::className(),[
        'name' => 'attachment_49[]',
        'options'=>[
            'multiple'=>true
        ],
        'pluginOptions' => [
            'initialPreview'=>    $previews,
            'initialPreviewAsData'=>true,
            //'initialCaption'=>"",
            'initialPreviewConfig' => $previewConf,
            'overwriteInitial'=>false,
            'maxFileSize'=>2000
        ]
    ]);
    ?>
    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
