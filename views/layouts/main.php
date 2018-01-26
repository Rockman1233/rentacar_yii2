<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\assets\PublicAsset;
use app\widgets\Alert;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

PublicAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">Rent a car</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="<? echo Url::toRoute(['site/index'])?>"">Home
                        <span class="sr-only">(current)</span>
                    </a>
                </li>

                <?php if(Yii::$app->user->isGuest):?>
                <li class="nav-item">
                    <a class="nav-link" href="<? echo Url::toRoute(['auth/login'])?>">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<? echo Url::toRoute(['auth/signup'])?>">Register</a>
                </li>
                <? else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="<? echo Url::toRoute(['cabinet/index'])?>">Cabinet</a>
                </li>
                <?=  Html::beginForm(['auth/logout'], 'post')
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->login . ')',
                        ['class' => 'btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
                    ?>
                <? endif; ?>

            </ul>
        </div>
    </div>
</nav>


<!-- Page Content -->
<?= $content ?>
<!-- /.container -->

<!-- Footer -->

<footer class="py-5 bg-dark">
    <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
    </div>
    <!-- /.container -->
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
