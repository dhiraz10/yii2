<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use backend\models\branches;
use backend\models\companies;

/* @var $this yii\web\View */
/* @var $model backend\models\departments */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="departments-form">

    <?php $form = ActiveForm::begin(); ?>

   
    <?= $form->field($model, 'branches_branch_id')->dropDownList(
        ArrayHelper::map(branches::find()->all(),'branch_id','branch_name'),['prompt'=>'select branch']
    ) ?>

   
    <?= $form->field($model, 'companies_company_id')->dropDownList(
        ArrayHelper::map(companies::find()->all(),'company_id','company_name'),['prompt'=>'select company']
    ) ?>

    <?= $form->field($model, 'department_name')->textInput(['maxlength' => true]) ?>

    


    <?= $form->field($model, 'department_status')->dropDownList(
            ['Active' => 'Active', 'Inactive' => 'Inactive'] ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
