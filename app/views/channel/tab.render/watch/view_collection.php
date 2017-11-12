<?php
use app\models\DateUtils;
?>
<div class="col-md-12" style="padding:0px;">
<div class="panel panel-default tr-panel">
    <div class="panel-heading">
        <h3 style="margin-top:4px;margin-bottom: 3px;display:inline;">
        <?= $model->label ?> 
        </h3>

        <span class="tr-gray-label">
            #<?= $model->id ?>
        </span>

        <span class="tr-gray-label">
            <?= $model->name ?>
        </span>

        <br/>

        <span class="tr-time">
            <span class="fa fa-clock-o"></span>
            <?= $model->lastUpdateFmt ?>
        </span>
    </div>
</div>
</div>

<div class="col-md-6">
<?php
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/stream/index.php",
        ["posts" => $model->posts($channel)]
    );
?>
</div>
