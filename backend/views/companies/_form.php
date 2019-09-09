<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use dosamigos\ckeditor\CKEditor;
use budyaga\cropper\Widget;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?>

    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_start_date',['inputOptions' => [
'autocomplete' => 'off']])->widget(
    DatePicker::className(), [
        // inline too, not bad
         'inline' => false, 
        
         // modify template for custom rendering
        // 'template' => '<div class="well well-sm" style="background-color: #fff; width:250px">{input}</div>',
        'clientOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-m-dd'
        ],
        
]);?>
    <?= $form->field($model, 'company_description')->widget(CKEditor::className(), [
        'options' => ['rows' => 6],
        'preset' => 'advance'
    ])?>


<?= $form->field($model, 'photo')->fileInput() ?>
     
    <?= $form->field($model, 'company_status')->dropDownList(
            ['Active' => 'Active', 'Inactive' => 'Inactive'] )?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
