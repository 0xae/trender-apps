<?php

/* @var $this \yii\web\View */
/* @var $content string */

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
            margin-left: 20px;
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
        }
    </style>
    <?php $this->head(); ?>
</head>

<body tabindex="0" class="b c d e">
<!-- Menu Area -->
<div class="g" id="toggleHeader">
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

<!-- Menu Area -->
<div class="t" ng-controller="SearchController">
    <div class="u v" role="banner" id="header" >
        <form method="get" action="#" class="w" ng-submit="doSearch(query)" novalidate>
            <table class="y" role="presentation">
                <tbody>
                    <tr>
                        <td class="z">
                        </td>
                        <td class="be bf">
                            <input class="bg bh bi" 
                                   name="query" 
                                   ng-model="query"
                                   placeholder="Search news, posts, videos, markets, ..." 
                                   autocomplete="off" 
                                   autocorrect="off" 
                                   spellcheck="false" 
                                   ng-focus="startedSearch()"
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

    <!--
    <div class="col-md-12" 
         ng-if="show_search_res"
         style="position:absolute;margin-left:13px;padding:0px;z-index:400;box-shadow:0px 0px 2px rgba(0,0,0,.3);height:400px;;margin-bottom:4px;width:90%;background-color: #fff"
         id="search_results">
        <div style="width:50%;float:left;display:block;padding: 10px;height:100%;">
            <h1></h1>
         </div>

        <div style="width:40%;float:right;display:block;padding: 10px;margin-right: 5px;" >
            <div class="cr cs" ng-click="dismissSearch()" style="float: right">
                <a href="javascript:void(0)" style="font-size: 13px"> <span class="j ct">close</span> </a>
            </div>
         </div>
    </div>
    -->
    <!-- .col-md-12 -->
</div>


<?php $this->beginBody() ?>
    <?= $content ?>
<?php $this->endBody() ?>


</body>

</html>
<?php $this->endPage() ?>
