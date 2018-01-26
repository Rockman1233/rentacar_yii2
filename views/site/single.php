<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="container">
    <div class="row">
        <div class="col-lg-3">
            <? if(!Yii::$app->user->isGuest): ?>
            <?php
            $form = ActiveForm::begin([
                'id' =>'order-form',
                'action' => ['site/contract'],
                'options' => ['class' => 'form-horizontal']
            ]) ?>
                <?= $form->field($model, 'first_date')->widget(kartik\date\DatePicker::className(), [

                    'pluginOptions' => [
                            'format' => 'yyyy-mm-dd',
                            'todayHighlight' => true,
                            'startDate' => 'today',
                            'autoclose' => true,
                     ]
                ]) ?>
                <?= $form->field($model, 'second_date')->widget(kartik\date\DatePicker::className(), [
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        'startDate' => '+1d',
                        'autoclose' => true,
                    ]
                ]) ?>
            <?= $form->field($model, 'car_id')->hiddenInput(['value'=> $car->id])->label(false); ?>

            <div class="form-group">
                <div class="col-lg-9">
                    <?= Html::submitButton('Order', ['class' => 'btn btn-primary btn-lg']) ?>
                </div>
            </div>
            <?php ActiveForm::end() ?>

            <? else: ?>
                <p>Необходима регистрация</p>
            <?endif;?>

        </div>
        <!-- /.col-lg-3 -->
        <div class="col-lg-9">
            <div class="card mt-4">
                <img class="card-img-top img-fluid" src="<? echo $car->getImage()?>" alt="">
                <div class="card-body">
                    <h3 class="card-title"><? echo $car->mark?> <? echo $car->model?></h3>
                    <h4 style="color: red">$<? echo $car->price?> per day</h4>
                    <p class="card-text"><? echo $car->description?></p>
                    <span class="text-warning">&#9733; &#9733; &#9733; &#9733; &#9734;</span>
                    4.0 stars
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>