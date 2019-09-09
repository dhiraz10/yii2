<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use kartik\editable\Editable; 
use kartik\popover\PopoverX; 

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DepartmentsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Departments';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="departments-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Departments', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute'=>'branches_branch_id',
                'value'=> 'branchesBranch.branch_name',
            ],

            // [
            //     'attribute'=>'companiesCompany.company_name',
            //     'value'=> 'companiesCompany.company_name',
            // ],
            [
                'attribute' => 'department_name',
                'class'         => 'kartik\grid\EditableColumn',
                'editableOptions'   => function($model, $key, $index) {
                    return [
                        'header'        => 'department name',
                        'name'=>'department_name', 
                        // 'model'=>$model, 
                        // 'asPopover' => true,
                        'size'=>'md',
                        'options' => ['class'=>'form-control', 'placeholder'=>'Enter department name...'],
                        // 'format' => 'button',
                        // 'editableValueOptions'=>['class'=>'well well-sm'],
                        'formOptions'   => [
                            'action'    => [
                                'departments/editable-demo'
                            ],
                        ] 
                        
                ];
            },
        ],
            // 'department_id',
           
            // 'companiesCompany.company_name',
            // 'department_name',
            'department_created',
            //'department_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>





    <?php Pjax::end(); ?>

</div>
