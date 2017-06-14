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
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <div class="container">
        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

