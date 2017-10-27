<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$this->beginPage();
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="static/lib/bootstrap/css/bootstrap.min.css" />
    <script src="static/requirejs/jquery.js"></script>
    <script src="static/lib/bootstrap/js/bootstrap.min.js"></script>
    <?php $this->head() ?>
<style>
body {
    /*padding-top: 50px;
    padding-left: 20px;
    padding-right: 20px;
    */
    background-color: #f6f5f3;
}

.tr-container {
    background-color: #fff;
    min-height: 100%;
}

.tr-section {
    margin: 15px;
}

.tr-section-title {
    color: dimgrey;
    font-weight: bold;
    font-size: 15px;
}

.tr-section-title .glyphicon{
    font-size: 12px;
}

.tr-section-content {
    margin-left: 20px;
}

a.tr-trend-item,
a.tr-more-item {
    font-size: 12px;
    font-weight: bold;
}

a.tr-trend-item:hover,
a.tr-more-item:hover  {
    text-decoration: none;
}

a.tr-trend-item {
}

a.tr-more-item {
}

ul.tr-settings {
    margin-left: 10px;
    margin-top: 30px;
}

ul.tr-settings li {
    margin-bottom: 20px;
}

ul.tr-settings li a {
    font-weight: bold;
    color: gray;
    font-size: 13px;
}

ul.tr-settings li a:hover {
    cursor: pointer;
    text-decoration: none;
}

ul.tr-settings li a span.fa {
    margin-right: 10px;
}


.col-xs-1, .col-sm-1, .col-md-1, .col-lg-1, 
.col-xs-2, .col-sm-2, .col-md-2, .col-lg-2, 
.col-xs-3, .col-sm-3, .col-md-3, .col-lg-3, 
.col-xs-4, .col-sm-4, .col-md-4, .col-lg-4, 
.col-xs-5, .col-sm-5, .col-md-5, .col-lg-5, 
.col-xs-6, .col-sm-6, .col-md-6, .col-lg-6, 
.col-xs-7, .col-sm-7, .col-md-7, .col-lg-7, 
.col-xs-8, .col-sm-8, .col-md-8, .col-lg-8, 
.col-xs-9, .col-sm-9, .col-md-9, .col-lg-9, 
.col-xs-10, .col-sm-10, .col-md-10, .col-lg-10,
 .col-xs-11, .col-sm-11, .col-md-11, .col-lg-11, 
.col-xs-12, .col-sm-12, .col-md-12, .col-lg-12 {
    padding-right: inherit;
    padding-left: inherit;
}
</style>
</head>
<body>
<?php 
$this->beginBody(); 
?>

<?= $content ?>

<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage(); ?>
