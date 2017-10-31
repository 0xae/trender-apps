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

#page_container {
    border-left: 1px solid #ccc;
    border-right: 1px solid #ccc;
    box-shadow: 0px 0px 2px rgba(0,0,0,.2);
    /* background-color: #efefef; */
}

.tr-container {
    background-color: #fff;
    min-height: 100%;
}

.tr-header {
    background-color: #000;
    /* padding: 5px; */
    padding-bottom: 0px;
}

.tr-section {
    /*
    margin: 15px;
    */
    margin-left: 10px;
    margin-bottom: 8px;
}

.tr-section-title {
    color: dimgrey;
    font-weight: bold;
    font-size: 15px;
}

.tr-section-title .glyphicon {
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
    /*
    margin-left: 10px;
    margin-top: 30px;
    */
    margin-left: 4px;
}

ul.tr-settings li {
    margin-bottom: 12px;
}

a {
    color: #3b5998;
}

.tr-a {
    color: #3b5998 !important;
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

/*h1, h2, h3, */
h4, h5, h6 {
    font-size: 1em;
    font-weight: bold;
}

p {
    font-size: small;
}

.tr-post-info {
    display: inline-block;
}

.tr-post-info h4.tr-author {
    display: inline-block;
    font-size: 13px;
    line-height: 0px;
    margin: 0px;
    margin-bottom: 4px;
}

.tr-post-details a,
.tr-post-details span {
    font-size: 12px;
}

.tr-post-description {
    margin-left: 5px;
}

.tr-post-image {
    width:50px;
    margin-right: 5px;
    margin-top:5px;
}

.tr-post-description p {
    margin-bottom: 4px;
    font-size: 12px;
}

.tr-img-container {
    display: block;
    max-height: 138px;
    max-width: 195px;
}

.tr-img-container img.tr-cover {
    height: 129px;
    margin-bottom: 10px;
}

.tr-img-container small {
    font-size: 12px;
    color: #fff;
    font-weight: bold;
}

.tr-img-display {
}

#posts_container_stream {
    padding-left: 10px;
    padding-top: 6px;
}

#posts_container {
    border-left: 1px solid #c5c4c4;
    border-top: 4px solid #fff;
    padding-left: 0px;
    padding-top: 0px;    
    padding-right: 0px;
    background-color: #efefef;
}

#posts_container .tr-post {    
    margin-bottom: 10px;
    /*
    background-color: #fff;
    padding: 6px;
    border-radius: 2px;
    border: 1px solid #ccc;
    */
}

#posts_loader {
    background-color: #fff;
    padding: 4px;
}

#posts_loader a p {
    margin-top: 10px;
}

#page_left_menu {
    margin-top: 15px;
    background-color: #fff;
}

#page_tab_menu {
    margin-bottom: 0px;
    /*
    margin-left: 24px;
    */
}

#page_tab_menu .nav-tabs {
    border-bottom: 0px;
}

#page_tab_menu .nav-tabs li a {
    font-weight: bold;
    font-size: 14px;
}

#page_tab_menu .nav-tabs li.active a {
    color: #3b5998;
}

.tr-page-title {
    margin-left: 0px;
    margin-top: 14px;
}

.tr-page-title h2 {
    font-size: 21px;
    margin-top: 0px;
    margin-left: 10px;
    color: #fff;
    font-weight: bold;
}

#tr-outdoor-img {
    /*
    width:100%;
    height:200px;
    margin-bottom: 10px;
    width: 350px;
    height: 230px;
    */
    width: 100%;
    background-color: #000;
    border-radius: 3px;
    padding: 1px;
}

#page_top_menu_container {
    margin-top: 3%;
}

.carousel-indicators {
    display: none;
}

#tr-search-opts {
    margin-bottom: 3px;
    margin-left: 2px;
}

#tr-search-opts li {
    padding-right: 0px;
    padding-left: 0px;
}

#tr-search-opts li .sep {
    color: gray;
}

#tr-search-opts li a {
    font-size: 11px;
    color: darkorange;
}

#tr-search-opts li.active a {
    font-weight: bold;
}

.carousel-caption {
    left: 0%;
    right: 0%;
    background-color: #000;
    opacity: .7;
    font-size: 12px;
    padding-top: 5px;
    padding-left: 5px;
    text-align: left;
    bottom: 0px;
}

#searchBox {
    border-radius: 2px;
    padding: 0px;
    padding-left: 4px;
    border: 4px solid #ccc;
    font-size: 18px;
}

#searchBox:active,
#searchBox:focus {
    /*border: 4px solid darkorange;*/
}

#page_top_menu_container .tr-page-title h2 {
    margin-bottom: 0px;
    margin-top: -6px;
}

.no-underline:hover {
    text-decoration: none;
}

#tr-outdoor-img img {
    /* width: 350px; */
    width: 100%;
    min-height: 190px;
    border-radius: 2px;
}

#tr-featured-content {
    padding: 10px;
    padding-top: 4px;
    padding-left: 4px;
}

.tr-main-badge {
    /*border: 1px solid #b22ec0;*/
    border: 2px solid orange;
    border-radius: 2px;
    /*color: #b22ec0;*/
    color: #fff;
    background-color: orange;
    display: inline-block;
    font-size: 11px;
    font-weight: bold;
    line-height: 12px;
    padding: 5px;
    cursor: pointer;
    box-shadow: 0px 0px 2px rgba(0,0,0,.6);
    /* hello there */
    position: absolute;
    top: 40%;
    left: 40%;    
}

.tr-badge-k {
    font-size: 11px;
    background-color: #3a5a9c;
}

.tr-main-badge:hover {
    color: #fff;
}

#page_right_col {
    background-color: #fff;
    /* margin-right: 30px; */
}

.tr-img-block {
    display:inline;
}

.tr-img-block img {
    width: 35px;
    height: 35px;
    margin-bottom: 3px;
    border-radius: 4px;
}

.rs-row {
    margin-right: 0px;
    margin-left: 0px;
}

.tr-link {
    cursor: pointer;
}

/*
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
*/

.tr-youtube-preview {
    padding-left: 0px;
    /*
    margin-right: -15px;
*/
}

.tr-youtube-preview img {
    width: 100%;
    height: 100%;
}

.tr-youtube-post {
    margin-right: 0px;
    margin-left: 0px;
    padding-left: 0px;
    padding-right: 0px;
    background-color: #fff;
}

.tr-youtube-post .tr-post-description {
    margin-left: 0px;
}

.tr-youtube-link {
}

.tr-video-miniplayer {
    color: orange;
    font-size: 31px;
    position: absolute;
    top: 45%;
    left: 45%;
}

.tr-video-time {
    font-size: 12px;
    position: absolute;
    right: 13%;
    top: 70%;
    color: #fff;
    background-color: rgb(0,0,0);
    opacity: .7 !important;
    font-weight: bold;
    padding: 2px;
    border-radius: 3px;
}

.tr-youtube-link a p {
    font-size: 11px;
}

.tr-see-more {
    font-size: 11px;
    text-decoration: underline;
}

.tr-txt-12 {
    font-size: 12px;
}

.tr-txt-11 {
    font-size: 11px;
}

.tr-txt-underline {
    text-decoration: underline;
}

#tr-trender {
    background-color: #fff;
    padding-top: 7px;
}

.trender-title {
    margin-top: 0px;
    margin-bottom: 0px;
    font-weight: bold;
    /*
    font-variant: small-caps;
    */
}

.trender-description {
    font-weight: bold;
    margin-left: 0px;
    margin-bottom: 0px;
}

.tr-text-orange {
    color: #F27405;
}

.tr-text-gray {
    color: gray;
}
</style>
</head>

<body>
<?php 
    $this->beginBody(); 
    echo $content;
    $this->endBody();
?>
</body>

</html>
<?php $this->endPage(); ?>
