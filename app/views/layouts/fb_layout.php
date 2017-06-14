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
        /*
#lightblue
#tomato
#orangered
        */
    </style>
    <?php $this->head() ?>
</head>

<body tabindex="0" class="b c d e" ng-app="trender">
    <?php $this->beginBody() ?>
        <?= $content ?>
    <?php $this->endBody() ?>
    <!-- lib -->
    <script src="static/lib/jquery/jquery-2.1.4.min.js" type="text/javascript"></script>
    <script src="static/lib/moment/min/moment.min.js" type="text/javascript"></script>
    <script src="static/lib/lodash/lodash.js" type="text/javascript"></script>
    <script src="static/lib/angularjs/angular.min.js" type="text/javascript"></script>

    <!-- trender angular app -->
    <script src="static/app/app.js" type="text/javascript"></script>
    <script src="static/app/services/PostService.js" type="text/javascript"></script>
    <script src="static/app/services/ProfileService.js" type="text/javascript"></script>
    <script src="static/app/controllers/homeController.js" type="text/javascript"></script>
    <script src="static/app/controllers/brandController.js" type="text/javascript"></script>
    <script src="static/app/controllers/searchController.js" type="text/javascript"></script>
</body>

</html>
<?php $this->endPage() ?>

