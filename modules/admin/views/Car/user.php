<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Car */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="car-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::dropDownList('user', $owner, $allusers, ['class'=>'form-control']); ?>

    <div class="form-group">
        <?= Html::submitButton('Submit' , ['class'=>'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
