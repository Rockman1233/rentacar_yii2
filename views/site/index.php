<!-- Page Content -->
<div class="container">
    <?
    if(Yii::$app->session->hasFlash('success')){
        echo Yii::$app->session->getFlash('success');
    }
    if(Yii::$app->session->hasFlash('error')){
        echo Yii::$app->session->getFlash('error');
    }
    ?>
    <!-- Jumbotron Header -->
    <header class="jumbotron my-4">
        <h1 class="display-3">A Warm Welcome!</h1>
        <p class="lead">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa, ipsam, eligendi, in quo sunt possimus non incidunt odit vero aliquid similique quaerat nam nobis illo aspernatur vitae fugiat numquam repellat.</p>
        <a href="#" class="btn btn-primary btn-lg">Call to action!</a>
    </header>

    <!-- Page Features -->
    <div class="row text-center">

        <?php

        use yii\helpers\Url;
        use yii\widgets\LinkPager;

        foreach ($models as $model):?>
        <!-- Page Features -->

            <div class="col-lg-3 col-md-6 mb-4">
                <div class="card">
                    <img class="card-img-top" src="<? echo $model->getImage()?>" alt="">
                    <div class="card-body">
                        <h4 class="card-title"><? echo $model->mark?> <? echo $model->model?></h4>
                        <p class="card-text"><? echo $model->description?></p>
                    </div>
                    <div class="card-footer">
                        <a href="<? echo Url::toRoute(['site/view', 'id' =>$model->id])?>" class="btn btn-primary">Заказать</a>
                    </div>
                </div>
            </div>

            <!-- /.row -->
        <?php endforeach; ?>

    </div>

        <?php
        // отображаем ссылки на страницы
        echo LinkPager::widget([
            'pagination' => $pages,
        ]);
        ?>

</div>
<!-- /.container -->
