<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Poitems */

$this->title = 'Create Poitems';
$this->params['breadcrumbs'][] = ['label' => 'Poitems', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poitems-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
