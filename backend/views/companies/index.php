<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use backend\models\companies;
use dosamigos\datepicker\DatePicker;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        
        <a id='modalButton', href="companies/create" class="btn btn-success">Create Companies</a>
    </p>
    <?php Modal::begin([
                'header'=>'<h4>Companies </h4>' ,
                'id'=>'modal',
                'size'=>'modal-lg',
                 ]);
                  echo "<div id='modalContent'></div>";
                  Modal::end();
            ?>

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
            [
                'attribute' => 'logo',
                'format' => 'raw',
                'label' => 'logo',
                'value' => function ($data) {
                    return Html::img(Yii::$app->request->BaseUrl.'/uploads/company_img/' . $data['logo'],
                        ['width' => '60px']);
                },
            ],

           
            //'company_status',
           

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
<?php
$js = <<<JS
  $('#modalButton').click(function (e) {
      e.preventDefault();
    $('#modal').modal('show')
      .find('#modalContent')
      .load($(this).attr('href'));
  });
JS;
$this->registerJs($js);
?>