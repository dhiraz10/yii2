<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\companies;
use dosamigos\datepicker\DatePicker;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Companies', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
     
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

        //    'company_id',
            // 'company_name',
            [
                // 'attribute'=>'company_name',
                'value'=>'company_name',
                'format'=>'raw',
                'filter'=>Select2::widget([
                    'model' =>  $searchModel,
                    'attribute'=>'company_id',
                    // 'name' => 'company_name',
                    'value' => 'company_name',
                    'data' => ArrayHelper::map(companies::find()->all(),'company_id','company_name'),
                    'options' => [ 'placeholder' => 'Select company ...'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ])
            ],
            'company_email:email',
            'company_address',
            // 'company_created',
        [
                    'attribute'=>'company_created',
                    'value'=>'company_created',
                    'format'=>'raw',
                            'filter'=>DatePicker::widget([
                                'model' => $searchModel,
                                'attribute' => 'company_created',
                                
                                    'clientOptions' => [
                                        'autoclose' => true,
                                        'format' => 'yyyy-m-dd'
                                    ]
            ])],
            //'company_status',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
