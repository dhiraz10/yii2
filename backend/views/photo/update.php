<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Photo */

$this->title = 'Update Photo: ' . $model->photo_id;
$this->params['breadcrumbs'][] = ['label' => 'Photos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->photo_id, 'url' => ['view', 'id' => $model->photo_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="photo-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
