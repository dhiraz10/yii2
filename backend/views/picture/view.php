<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Picture */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pictures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="picture-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pic_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pic_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pic_id',
            // 'image:ntext',
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
        ],
    ]) ?>

</div>
