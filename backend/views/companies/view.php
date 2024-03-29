<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\companies */

$this->title = $model->company_name;
$this->params['breadcrumbs'][] = ['label' => 'Companies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="companies-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->company_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->company_id], [
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
            // 'company_id',
            'company_name',
            'company_email:email',
            'company_address',
            'company_created',
            'company_status',
            // 'logo',
			[
                'attribute' => 'logo',
                'format' => 'raw',
                'label' => 'logo',
                'value' => function ($data) {
                    return Html::img(Yii::$app->request->BaseUrl.'/uploads/company_img/' . $data['logo'],
                        ['width' => '60px']);
                },
            ],
        ],
    ]) ?>

</div>
