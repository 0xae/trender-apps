<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;
use app\models\Trender;

AppAsset::register($this);
$controllerId = Yii::$app->controller->id;
$controllerHref = "index.php?r=$controllerId/index";
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
    <link rel="stylesheet" href="static/css/trender-app.css" />
    <link rel="stylesheet" href="static/css/trender-feed.css" />
</head>

<body>
<?php
$apiHost = Trender::api();
$mediaHost = Trender::media();
$script = <<<JS
define("trender/app", function() {
    var service={
        api: function() {
            return '$apiHost';
        },

        media: function() {
            return '$mediaHost';
        }
    };

    return service;
});
JS;
$this->registerJs($script);
?>

<div class="">
    <div class="row rs-row" id="page_container">        
        <div class="col-md-12" id="tr-trender">
            <?php
                echo \Yii::$app->view->renderFile(
                    "@app/views/layouts/feed_navbar.php",
                    []
                );
            ?>
        </div>

        <?php 
            $this->beginBody(); 
            echo $content;
            $this->endBody();
            ?>
        ?>
    </div>
</div>
</body>

</html>
<?php $this->endPage(); ?>

