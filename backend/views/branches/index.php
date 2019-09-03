<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
use yii\helpers\Url;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\BranchesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Branches';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="branches-index">

    <h1 class="test"><?= Html::encode($this->title) ?></h1>

    <p>
       
       
    <a id='modalButton', href="branches/create" class="btn btn-success">try</a>
    </p>
        <?php Modal::begin([
                'header'=>'<h4> Branches </h4>' ,
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
        'rowOptions'=>function($model){
            if ($model->branch_status =='Inactive')
            {
                return ['class'=>'danger'];
            }
            elseif ($model->branch_status =='Active')
            {
                 return['class'=>'success'];
            }
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute'=>'companies_company_id',
                'value'=>'companiesCompany.company_name',
            ],

            // 'branch_id',
            // 'companiesCompany.company_name',
            'branch_name',
            'branch_address',
            'branch_created',
            'branch_status',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

<?php
// $js = <<<JS
//   $('#modalButton').click(function (e) {
//       e.preventDefault();
//     $('#modal').modal('show')
//       .find('#modalContent')
//       .load($(this).attr('href'));
//   });
// JS;
// $this->registerJs($js);
?>

