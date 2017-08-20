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
<style>
body {
    padding-top: 50px;
}
.media {
    margin-top: 0px;
}
.trender-post {
    cursor: pointer;
    padding-left: 10px;
    padding-top: 14px;
    padding-bottom: 14px;
    border-bottom: 1px solid #f5eeee;
}

.trender-post:hover {
    background-color: rgba(0,0,0,.05);
}

.tr-header {
    background: url(static/img/satelite.png) no-repeat;
    background-position: 89% 58%;
    background-size: cover;
}

li.menu-link a {
    font-size: 16px;
}

li.menu-link a strong {
    font-size: 13px;
}

div.entry-box {
    background-color: #E8FAF2;
    padding: 20px;
}
a.new_posts {
    color: inherit;
}

.alert-new-posts {
    background-color: #E8FAF2;
}

.tr-welcome {
    color: #c8e1ff;
}
.tr-sec-title {
    font-size: 18px;
    font-weight: bold;
    color: #444;
}

.special-link {
    color: #19CF86;
}

h3.special-link {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 10px;
    margin-top: 10px;
}

h3.special-link small {
    font-size: 11px;
}

.tr-top-title {
    color: #fff;
    margin:0px;
    padding: 5px;
    text-shadow:0px 0px 4px #000;
    font-weight: bold;
    padding-top:0px;
}

p.tr-outdoor-content {
    color: #fff;
    margin:0px;
    padding: 0px;
    text-shadow:0px 0px 4px #000;
    font-weight: bold;
    font-size: 11px;
    margin-left: 5px;
}
.tr-top-menu {
}

.tr-top-menu li {
    margin:0px;
    padding-left:12px;
    
}

.tr-top-menu li a.top-link:hover,
.tr-top-menu li a.top-link:focus
{
    background-color: #666;
}

.tr-top-menu li a.settings-link:hover,
.tr-top-menu li a.settings-link:focus
{
    background-color: transparent;
}

.tr-top-menu li a {
    padding:4px;
    padding-left:6px;
    padding-right:6px;
    font-size:12px;
    margin:0px;
    color: #fff;
    border-radius:0px;
}

.tr-outside {
    background-color: #EEE; /*to make it visible*/
    height: 200px;
}
.tr-inside {
    position: relative;
    height: 200px;
    top: 67%;
}
.row {
}

.search-btn .input-group-addon{
    border-top: 1px solid transparent;
    -webkit-box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
    box-shadow: inset 0 1px 0 rgba(255, 255, 255, .1);
    color: #fff;
    background-color:#d43b03;
    border:1px solid #000;
}

.search-btn .input-group-addon a{
    color: #fff;
}

.search-btn input {
    background-color: rgba(19, 10, 0, 0.9);
    border:0px;
    font-size:13px;
    color: #999;
}

.search-area {
    margin-top:70px;
    margin-bottom:50px;
}

.cat-btn {
    font-size: 12px;
    padding: 3px;
    padding-left: 8px;
    padding-right: 8px;
    font-weight: bold;
}

.category-link {
    font-weight: bold;
}
a.category-link:hover,
a.category-link:focus,
a.category-link:hover {
    font-weight: bold;
    text-decoration: none;
}
a.category-link:visited {
    font-weight: bold;
    text-decoration: underline;
}
.tr-category-stats {
    color: #ccc;
    font-size: 12px;
}
.tr-section-title {
    font-size:12px;
    color: dimgrey;
    font-weight: bold;
}
.tr-category-loadmore {
    font-size: 12px;
}
.tr-category {
    margin:0px;
    margin-bottom: 6px;
}
.tr-type-log label {
    font-size: 12px;
    padding: 2px;
    padding-left: 8px;
    padding-right: 8px;
}
.tr-search-results-count{
    color: #999;
    margin:0px;
    padding: 0px;
    font-weight: bold;
    font-size: 12px;
    border:0px;
    margin-bottom: 20px;
}

.row {
margin-left:inherit;
margin-right:inherit;
}

ul.navbar-nav li.active a {
    color:  #19CF86 !important;
    background-color: transparent !important;
}

ul.navbar-nav li a:hover {
    color:  #19CF86 !important;
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
<?php $this->beginBody(); ?>

<?= $content ?>

<?php $this->endBody();?>
</body>
</html>
<?php $this->endPage(); ?>
