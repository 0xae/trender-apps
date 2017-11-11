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
    <?php $this->head() ?>
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

requirejs(["jquery", "bts"], function ($, bts){
    $("a.tx-tab").on("click", function (e){
        e.preventDefault();
    });

    $("a.tx-new-tab").on("click", function (e){
        var self=this;
        e.preventDefault();

        var tabid=$(this).attr("data-tab-id");
        var tabname=$(this).attr("data-tab-name");
        var tabhref=$(this).attr("data-tab-href");
        var cacheid = $(this).attr("data-cache-id");

        console.info("going to ", tabname);

        if (!tabid || !tabhref) {
            throw new Error("Invalid tab request. `tabid` and `tabhref` are required.");
            return;
        }

        // there is no tabname, well, open it on the default tab pane!
        if (!tabname) {
            tabname=tabid+"_default";
        }

        var shouldLoad = (cacheid != tabhref);

        if (shouldLoad) {
            $.get(tabhref)
            .then(function (data){
                $(tabname+" .content").remove();
                $(tabname).html("<div class='content'>"+ data +"</div>");
                $(self).tab('show');
            }, function (error) {
                console.error("couldnt render %s %s ", tabname, error.responseText);
            });
        } else {
            $(self).tab('show');
        }
    });    
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
    </div>
</div>
<script src="static/lib/bootstrap/js/bootstrap.min.js"></script>
</body>

</html>
<?php $this->endPage(); ?>

