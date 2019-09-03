<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\PoitemsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Poitems';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poitems-index">


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'po_item_no',
            'quantity',
            //'po_id',

            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
