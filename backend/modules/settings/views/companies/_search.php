<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\settings\models\CompaniesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'company_id') ?>

    <?= $form->field($model, 'company_name') ?>

    <?= $form->field($model, 'company_email') ?>

    <?= $form->field($model, 'company_address') ?>

    <?= $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'company_start_date') ?>

    <?php // echo $form->field($model, 'company_description') ?>

    <?php // echo $form->field($model, 'company_created') ?>

    <?php // echo $form->field($model, 'company_status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
