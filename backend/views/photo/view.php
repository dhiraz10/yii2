<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Photo */

$this->title = $model->photo_id;
$this->params['breadcrumbs'][] = ['label' => 'Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="photo-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->photo_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->photo_id], [
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
            'photo_id',
            // 'image'
            [
                'attribute' => 'image',
                'format' => 'raw',
                'label' => 'image',
                'value' => function ($data) {
                    return Html::img(Yii::$app->request->BaseUrl.'/uploads/company_img/' . $data['image'],
                        ['width' => '60px']);
                },
            ],
        ],

    ]) ?>

</div>
