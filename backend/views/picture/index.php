<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pictures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="picture-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Picture', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pic_id',
            // 'picture:ntext',
            [
                'attribute' => 'image',
                'format' => 'raw',
                'label' => 'image',
                'value' => function ($data) {
                    return Html::img(Yii::$app->request->BaseUrl.'/uploads/' . $data['image'],
                        ['width' => '60px']);
                },
            ],
            'title',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
