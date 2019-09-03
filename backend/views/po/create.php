<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\po */

$this->title = 'Create Purchase';
$this->params['breadcrumbs'][] = ['label' => 'Purchase', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="po-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPoItems' => $modelsPoItems,
    ]) ?>

</div>
