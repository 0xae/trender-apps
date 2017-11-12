<?php
use app\models\DateUtils;
?>
<div class="col-md-12" style="padding:0px;">
<div class="panel panel-default tr-panel">
    <div class="panel-heading">
        <h3 style="margin-top:4px;margin-bottom: 3px;display:inline;">
            <img src="static/img/like.png" style="display: inline;width:16px;" >
            Likes
        </h3>

        <br/>

        <span class="tr-time">
            most favorite content
        </span>
    </div>
</div>
</div>

<div class="col-md-6">
<?php
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/stream/index.php",
        ["posts" => $coll->posts($channel)]
    );
?>
</div>
