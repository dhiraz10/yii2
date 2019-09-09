<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use budyaga\cropper\Widget;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model backend\models\Photo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="photo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'image')->widget(Widget::className(), [
        'uploadUrl' => Url::toRoute('companies/uploadPhoto'),
        
        
    ]) ?>
    <?php //echo Html::img(Yii::getAlias('@backend').'/'.$model['image']);
?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
