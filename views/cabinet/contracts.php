<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="container">
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-success']) ?>
    </div>
    <?php \yii\widgets\Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                    'attribute' => 'car_id',
                    'value' => 'car.state_num'
            ],
            [
                'attribute' => 'driver_id',
                'value' => 'driver.name'
            ],
            'status',
            'first_date',
            'second_date',
            // 'status',
            // 'foto:ntext',
            // 'description:ntext',

            ['class' => 'yii\grid\ActionColumn',
            'template' => "{confirm} {decline}",
                'buttons' => [
                    'confirm' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-ok"></span>',
                            $url, [
                            'title' => Yii::t('yii', 'confirm'),
                            'data-confirm' => Yii::t('yii', 'Сдать авто?'),
                            'data-method' => 'post',
                            'data-pjax' => 0,
                            'data-params' => [
                                'new_stat' => 1,
                                'id' => $model->id,
                            ],
                        ]);
                    },
                    'decline' => function ($url, $model, $key) {
                        return Html::a('<span style="color: red" class="glyphicon glyphicon-remove"></span>',
                            $url, [
                            'title' => Yii::t('yii', 'decline'),
                            'data-confirm' => Yii::t('yii', 'Отказ?'),
                            'data-method' => 'post',
                            'data-pjax' => 0    ,
                            'data-params' => [
                                'new_stat' => 2,
                                'id' => $model->id,
                            ],
                        ]);
                    }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                    if ($action === 'confirm') {
                        $url ='contracts';
                        return $url;
                    }
                    if ($action === 'decline') {
                        $url ='contracts';
                        return $url;
                    }
                }
            ]
        ]
    ]); ?>
    <?php \yii\widgets\Pjax::end(); ?>
</div>