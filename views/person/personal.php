<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;

$this->title = 'Personal Info';
$this->params['breadcrumbs'][] = $this->title;
//$user = $dataProvider->getModels()['0']

?>
<div class="site-about">
    <div class="container">
        <?= Html::a('Back', ['index'], ['class' => 'btn btn-success']) ?>
    </div>

    <? GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            'birthday',
            'drive_license',
            'login',
            // 'foto:ntext',
            // 'description:ntext',

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{update}',
                'buttons' => [
                    'update' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                            'title' => Yii::t('app', 'lead-update'),
                        ]);
                }
                ],
                'urlCreator' => function ($action, $model, $key, $index) {
                if ($action === 'update') {
                    $url ='personaldetails?id='.$model->id;
                    return $url;
                }}
        ],
    ]]); ?>


</div>