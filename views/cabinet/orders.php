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
    <?/* GridView::widget([
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

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Car</th>
            <th scope="col">Start</th>
            <th scope="col">Finish</th>
            <th scope="col">Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dataProvider->getModels() as $item):?>
        <tr>
            <th scope="row">Order ID <?= $item->id ?> </th>
            <td><?= $item->car->mark ?> <?= $item->car->model ?> <?= $item->car->state_num ?></td>
            <td><?= $item->first_date ?></td>
            <td><?= $item->second_date ?></td>
            <td><?php if($item->status==0): ?><span class="glyphicon glyphicon-hourglass fa-1x"> Заявка рассматривается<?php endif; ?>
                    <?php if($item->status==1): ?><span class="glyphicon glyphicon-ok fa-1x"> Заявка одобрена<?php endif; ?>
                        <?php if($item->status==2): ?><span class="glyphicon glyphicon-ban-circle fa-1x"> Заявка отклонена<?php endif; ?></td>
        </tr>
        <? endforeach; ?>
        </tbody>
    </table>

</div>