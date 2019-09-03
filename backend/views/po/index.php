<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use common\models\PoitemsSearch;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Purchase';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="po-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Purchase', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'export'=>false,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
       
        'columns' => [
            [
                'class' => 'kartik\grid\ActionColumn',
                'dropdown' => true,
                'vAlign'=>'middle',
              
             ],

             [
                 'class'=>'kartik\grid\ExpandRowColumn',
                 'value'=>function ($model, $key, $index) { 
                    return GridView::ROW_EXPANDED;
                },
                'detail'=>function ($model, $key, $index) { 
                    $searchModel = new PoitemsSearch();
                    $searchModel -> po_id =$model->id;
                    $dataProvider =$searchModel ->search(Yii::$app->request->queryParams);
                    return Yii::$app->controller->renderPartial('_poitems', [
                        'searchModel'=>$searchModel,
                        'dataProvider'=>$dataProvider
                    ]);
                   
                },
            ],
               
            'po_no',
            'description:ntext',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
