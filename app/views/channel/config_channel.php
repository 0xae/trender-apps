<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\DateUtils;

$action='index.php?r=channel/update&id=' . $model->id;
$title = "#<a href='#'>" . $model->name . '</a>';
$descr = "nuts and bolts";

$this->title = "Configuring {$model->name}";
?>

<style type="text/css">
.tr_query_results {
}
</style>

<div class="row rs-row tr-header-panel">
    <div class="col-md-12 tr-header-inner">
        <h1>
            <center>
            <span class="glyphicon glyphicon-random"></span>
            <?= $model->name ?>
            </center>
        </h1>
    </div>
</div>

<div class="row rs-row" style="height: 400px;">
    <div class="col-md-2">
        <h4 style="margin-bottom:3px;">
            <?= $model->name ?>
        </h4>
        <p>
            <span class="fa fa-lock <?= ($model->audience=='public') ? 'text-warning' : 'text-success' ?> "></span>
            <small style="color: gray">
                <strong><?= $model->audience?> channel</strong>
            </small>
            <br/>
            <span class="glyphicon glyphicon-time"
                 style="font-size:11px;color:gray"></span>
            <small style="color: gray"
                title="Last update at <?=$model->lastUpdateFmt?>">
                <strong><?= $model->lastUpdateFmt ?></strong>
            </small>
        </p>

        <!--
        <h4>Settings</h4>
        <ul class="list-unstyled">
            <li><a href="#"><strong>Search</strong></a></li>
            <li><a href="#"><strong>Plugins</strong></a></li>
            <li><a href="#"><strong>Inteligence</strong></a></li>
            <li><a href="#"><strong>Curation</strong></a></li>
            <li><a href="#"><strong>General</strong></a></li>
        </ul>

        <h4>Filter by</h4>
        <ul class="list-unstyled">
            <li><a href="#"><strong>Most Recent</strong></a></li>
            <li><a href="#"><strong>Most Popular</strong></a></li>
            <li><a href="#"><strong>Most Active</strong></a></li>
            <li><a href="#"><strong>Hot right now</strong></a></li> 
        </ul>
 
        <h4>Order by</h4>
        <ul class="list-unstyled">
            <li><a href="#"><strong>Relevance</strong></a></li>
            <li><a href="#"><strong>Time</strong></a></li>
            <li><a href="#"><strong>Curation</strong></a></li>
            <li><a href="#"><strong>Activity</strong></a></li>
            <li><a href="#"><strong>Size</strong></a></li>
        </ul>
        -->
    </div>

    <div class="col-md-10" style="padding: 0px;min-height: 600px;background-color: #f7f3f3;">
        <div class="row rs-row" style="height: 400px;">
            <div class="col-md-12" style="padding:3px;padding-left:3px;">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:12px;color:gray">
                        <form class="form-inline">
                            <div class="form-group">
                                <input 
                                    type="text" style="width: 800px"
                                    class="form-control tr-input-text"
                                    placeholder="Type url"
                                    id="queryUrl" 
                                />
                            </div>

                            <button type="button" 
                                style="font-size:11px;"
                                class="btn btn-default btn-primary">
                                <strong>Search</strong>
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-12" id="tr_query_results">
                <?php
                    echo \Yii::$app->view->renderFile(
                        "@app/views/plugins/stream/index.php",
                        ["posts" => $posts]
                    );
                ?>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
requirejs(['trender/app', 't/zsearch', 'jquery'], function (app, zsearch, $){
    $("#submitSearch").on("click", function(){
        console.info("hello");
    });
})
JS;
$this->registerjs($js);
