<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use dosamigos\datepicker\DatePicker;
use dosamigos\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

   <?php $form = ActiveForm::begin([
                    'options'=>['enctype'=>'multipart/form-data'],
                    // 'enableAjaxValidation'=>true,
                    ]); ?>





    <?= $form->field($model, 'company_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'company_address')->textInput(['maxlength' => true]) ?>

   <?= $form->field($model, 'photo')->fileInput() ?>
    
    <?= $form->field($model, 'company_start_date')->widget(
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

<?= $form->field($model, 'company_description')
         ->widget(CKEditor::className(), 
            [
              'options' => [], 
              'preset' => 'custom',
              'clientOptions' => [
                  'extraPlugins' => '',
                  'height' => 500,

                  //Here you give the action who will handle the image upload 
                  'filebrowserUploadUrl' => '/site/ckeditor_image_upload',

                  'toolbarGroups' => [
                      ['name' => 'undo'],
                      ['name' => 'basicstyles', 'groups' => ['basicstyles', 'cleanup']],
                      ['name' => 'paragraph', 'groups' => ['list', 'indent', 'blocks', 'align', 'bidi' ]],
                      ['name' => 'styles'],
                      ['name' => 'links', 'groups' => ['links', 'insert']]
                  ]

              ]

            ]) 

?>
      
        

    <?= $form->field($model, 'company_status')->dropDownList(
	  ['Active' => 'Active', 'Inactive' => 'Inactive']
            ) ?>

           

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
