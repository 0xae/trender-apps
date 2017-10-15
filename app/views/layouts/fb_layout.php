<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
$timelineId = @$_GET['id'] ? $_GET['id'] : '1';
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="static/css/fb.main.css"  />
    <link rel="stylesheet" href="static/fonts/font-awesome.min.css"> 
    <style type="text/css">
        .good-syrene {
            padding: 3px;
            background-color: greenyellow;
            display: inline-block;
            border-radius: 15px;
        }

        .alarm-syrene {
            padding: 3.5px;
            background-color: tomato;
            display: inline-block;
            border-radius: 15px;
        }

        .di {
            padding: 12px;
            margin: 0px;
            border-style: none;
            border-bottom: 1px solid #eee;
        }

        .d #viewport {
            margin: 0px;
            margin-left: 10px;
            max-width: initial;
            display: inline-flex;
        }
        
        div#objects_container {
            width: 600px;
            display: inline-block;
        }
        div.brand-picture-instance {
            display:inline;
        }
        td span.alarm-syrene {
            margin-top: -19px;
            margin-left: -9px;
        }
        div#sidebar {
            width: 400px;
            margin-left: 20px;
            background-color: #fff;
            padding: 10px;
            height: 500px;
        }
        
        #app-left-col {
            width: 250px;
            background-color: #fff;
            min-height: 900px;
            float: left;            
        }
        
        #app-left-col .tr-section {
            padding: 10px;
            border-bottom: 1px solid #eee;
        }
        
        .tr-description {
            font-size: 11px;
            color: gray;
        }
        
        .fa {
            background-color: transparent !important;
            border: 1px solid transparent !important;
            color: inherit !important;
        }
        
        .tr-link {
            font-size: 12px;
            text-decoration: underline !important;
        }
        
        #app-header-menu {
        }
        
        #app-header-menu #header {
        }

        #app-header-ads {
        }
        
        #app-video-stream {
            width: 430px;
            float: right;
            margin-left: 8px;
        }
        
        .tr-main-badge {
            /*border: 1px solid #b22ec0;*/
            border: 2px solid orange;
            border-radius: 2px;
            /*color: #b22ec0;*/
            color: orange;
            display: inline-block;
            font-size: 11px;
            font-weight: bold;
            line-height: 12px;
            padding: 5px;
            cursor: pointer;
        }
        
        .tr-main-badge:hover {
            color: #fff;
        }
        
        ul.tr-menu {
        }

        ul.tr-menu li{
            display: inline;
        }
        
        ul.featured-youtube-post li{
            padding: 28px;
            font-size: 14px;
            color: gray;
        }

        ul.featured-youtube-post > li{
            padding-left: 0px;
        }

        ul.normal-youtube-post li{
            color: gray;
        }
        
        .tr-shadow {
            filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#66000000',GradientType=0 );
            opacity: 1;
            width: 100%;
            height: 200px;
            height:10px
        }
        
        .tr-shadow center div.tr-mini-play {
            padding-top:20px;
            color:red;
            font-size: 25px;
        }
        
        .tr-img-loader {
            width:146px;
            float:left;
            margin-right: 5px;
        }

        .tr-loading-ellipsis {
            position: absolute;
            margin-top: 15px;
            margin-left: 12px;
        }

        .tr-up-next {
            /*
            max-height: 400px;
            overflow-y: scroll;
            */
        }

        .youtube-post {
            cursor: pointer;
        }

        .tr-up-next .youtube-post {
            opacity: .7;
        }

        .tr-up-next .youtube-post:hover {
            opacity: 1;
        }

        .tr-video-time {
            opacity: .7 !important;
            float: right;
            font-size:12px;
            margin-right:5px;
            background-color: rgb(0,0,0);
            border-radius:2px;
            padding-right:5px;
            padding-left:4px;
        }

        .v1-btn {
            font-size: 11px;
            border-color: #3b5998;
            border: 1px solid;
            border-radius: 2px;
            padding-left: 4px;
            padding-right: 4px;
            padding-bottom: 2px;
            padding-top: 2px;            
            background-color: #fff !important;
            font-weight: bold;
            color: #3b5998;
        }

        .v1-btn:hover,
        .v1-btn:active,
        .v1-btn:focus {
            background-color: #fff !important;
            border-color: #3b5998;
            color: #3b5998 !important;
            cursor: pointer;
        }

        .v1-btn .tr-btn-log {           
            font-size: 10px;            
        }

        .v1-input {
            font-size: 12px;
            border-radius: 2px;
            border-color: gray;
            border-width: 1px;
            border-style: solid;
            padding-left: 4px;
        }
        
        .tr-section h3 {
            font-size: .86em;
        }
        
        .tr-link-opts {
            color: orange !important;
            font-size:11px !important;
            float:right !important;
            padding-top: 2px;
            text-decoration: underline !important;
        }
        
        .tr-link-opts:hover {
            background-color: transparent !important;
        }
        
        #tr-outdoor-img {
            width:100%;
            height:200px;
            margin-bottom: 10px;
            /*sbackground-color: #000;*/
        }
        
        .tr-up-next-label {
            margin: 0px;
            background-color:#fff;
            width:100%;
            display:block;  
            height: 20px;
            padding-top: 2px;
            padding-bottom: 2px;
            opacity: .7;
            border-bottom: 1px solid #eee;
        }
        
        .tr-up-next-label h1 {
            float: right;
            color: gray;
            font-size: 14px;
            padding-right: 15px;
        }
        
        .tr-ref {
            float: right;
            font-size: 11px;
            color: gray;
            padding: 2px;
            padding-top: 0px;
            border-radius: 2px;
            padding-right: 4px;
        }
        
        .youtube-mini-post {
            width:146px;
            height:78px;
            border-radius:3px;        
        }
    </style>
    
    <script src="static/lib/require.js"></script>
    <?php $this->head(); ?>
</head>

<body tabindex="0" class="b c d e">

<div class="t" id="app-header-menu">
    <div class="g" id="app-header-ads">
        <div id="toggleHeaderContent" class="h">
            <div class="i">
                <div class="j">
                    <span class="k">Welcome to Trender Platform!</span>
                </div>
                <div class="o">
                    <a class="p r" href="javascript:void(0)">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="u v" role="banner" id="header">
        <form method="get" action="index.php?r=timeline/search" class="w" novalidate>
            <table class="y" role="presentation">
                <tbody>
                    <tr>
                        <td class="z">
                        </td>
                        <td class="be bf">
                            <input class="bg bh bi" 
                                   name="q" 
                                   placeholder="Search news, posts, videos, markets, ..." 
                                   autocomplete="off" 
                                   autocorrect="off" 
                                   spellcheck="false" 
                                   type="text" 
                            />
                        </td>
                        <td class="z">
                            <input style="display: block" 
                                   value="Search" 
                                   type="submit" 
                                   class="p bj bk bl"
                             />
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

        <div role="navigation" class="bm" style="clear:both">
            <a class="bn <?=(Yii::$app->controller->id == 'timeline')?'bo':''?> bp" href="index.php?r=timeline/index&id=<?= $timelineId ?>" aria-current="page">
                <span class="fa fa-newspaper-o"
                      style="background-color:transparent;border:0px;"></span>
                News
            </a>
            <a class="bn <?=(Yii::$app->controller->id == 'trending')?'bo':''?>  bp" href="index.php?r=trending/index">
                Trending Now <sup> <span class="alarm-syrene"></span></sup>
            </a>
            <a class="bn <?=(Yii::$app->controller->id == 'live')?'bo':''?> bp" href="index.php?r=live/index">
                Live Tv
            </a>
            <a class="bn <?=(Yii::$app->controller->id == 'market')?'bo':''?> bp" href="index.php?r=market/index">
                Markets
            </a>
        </div>
    </div>
</div>


<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>

</body>

</html>
<?php $this->endPage() ?>
