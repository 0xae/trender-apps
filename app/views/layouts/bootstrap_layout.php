<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" ng-app="trender">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<nav class="navbar-inverse navbar-fixed-top trender-color navbar" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/trender/app/index.php" style="color: #d7cceb;">
                <!-- <span style="color: #ccc" class="fa fa-google-wallet"></span> -->
                Trender
             </a>
        </div>
        <div id="w0-collapse" class="collapse navbar-collapse">
            <ul id="w1-ul-li-ul" class="navbar-nav navbar-right nav">
                <li>
                    <a href="/trender/app/index.php?r=home/index" style="color: #d7cceb;">Home</a>
                </li>
                <!--
                <li>
                    <a href="/trender/app/index.php?r=platform/index" style="color: #d7cceb;">Platform</a>
                </li>
                <li>
                    <a href="/trender/app/index.php?r=tv/index" style="color: #d7cceb;">Tv</a>
                </li>
                <li>
                    <a href="/trender/app/index.php?r=system/index" style="color: #d7cceb;">System Stats</a>
                </li>
                -->
                <li>
                    <a href="/trender/app/index.php?r=settings/index" style="color: #d7cceb;">Settings</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div style="margin-top:30px;padding:0px;">
     <?= $content ?>
 </div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><i>&copy; trender 2017</i></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
