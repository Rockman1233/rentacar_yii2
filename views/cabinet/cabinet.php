<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Cabinet';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <div class="container">
        <?= Html::a('Add your car', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Show orders of your cars', ['contracts'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Show your orders', ['your-contracts'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Edit personal Info', ['./person/view'], ['class' => 'btn btn-success']) ?>
    </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'format' => 'raw',
                'label' => 'Image',
                'value' => function($data){
                    return Html::img(($data->getImage()), ['width' => 250]);
                }
            ],
            'mark',
            'model',
            'colour',
            'state_num',

             'price',
            // 'status',
            // 'foto:ntext',
            // 'description:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
