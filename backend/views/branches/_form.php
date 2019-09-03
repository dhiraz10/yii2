<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\companies;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\branches */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="branches-form">

    <?php $form = ActiveForm::begin(); ?>

    
 

          <?=   $form->field($model, 'companies_company_id')->widget(Select2::classname(), [
                'data' =>  ArrayHelper::map(companies::find()->all(),'company_id','company_name'),
                'language' => 'en',
                'options' => ['placeholder' => 'Select a state ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]);?>
    <?= $form->field($model, 'branch_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'branch_address')->textInput(['maxlength' => true]) ?>

   

    <?= $form->field($model, 'branch_status')->dropDownList(
            ['Active' => 'Active', 'Inactive' => 'Inactive'] ,['prompt'=>'Status']
            ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
