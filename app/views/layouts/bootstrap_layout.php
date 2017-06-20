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
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <nav class="navbar-inverse navbar-fixed-top trender-color navbar" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#w0-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/trender/app/index.php">
                         <img alt="Brand" src="static/img/tv-yellow2.png" style="width: 90px"> </a>
            </div>
            <div id="w0-collapse" class="collapse navbar-collapse">
                <ul id="w1-ul-li-ul" class="navbar-nav navbar-right nav">
                    <li>
                        <a href="/trender/app/index.php?r=platform%2Findex">Platform</a>
                    </li>
                    <li>
                        <a href="/trender/app/index.php?r=tv%2Findex">Tv</a>
                    </li>
                    <li>
                        <a href="/trender/app/index.php?r=tv%2Findex">System Stats</a>
                    </li>
                    <li>
                        <a href="/trender/app/index.php?r=settings%2Findex">Settings</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left"><i>ayrton@thinkpad</i></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
