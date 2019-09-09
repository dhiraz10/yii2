<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Picture */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="picture-form">

    <?php $form = ActiveForm::begin(); ?>

   <?= $form->field($model, 'image')->widget(\bilginnet\cropper\Cropper::className(), [
    'cropperOptions' => [
        'width' => 100, // must be specified
        'height' => 100, // must be specified
     ]
]); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
