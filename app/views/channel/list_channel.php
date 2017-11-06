<?php
$count = count($data);
$left = 48 - $count;
$title = $audience . " channels";
$descr = "";
$this->title = $title;
?>

<div class="row rs-row tr-header-panel">
    <div class="col-md-12 tr-header-inner">
        <h1>
            <center>
            <span class="glyphicon glyphicon-random"></span>
            Channels
            </center>
        </h1>
    </div>
</div>

<div class="row rs-row" style="height: 400px;">
    <div class="col-md-2">
    <?php
        echo \Yii::$app->view->renderFile (
            "@app/views/channel/menu_channel.php", [
                "menuConf" => [
                    "label" => $title,
                    "descr" => $descr
                ]
            ]
        );
    ?>
    </div>

    <div class="col-md-10" style="padding: 0px;min-height: 600px;background-color: #f7f3f3;">
        <div class="row rs-row" style="height: 400px;">

            <div class="col-md-12" style="padding: 0px;">
                <?php foreach ($data as $c): ?>
                    <div class="col-md-2 tr-channel-panel"
                         title="Channel <?= $c->name ?>">
                        
                        <div class="tr-channel-delete text-danger" 
                             data-channel-id="<?=$c->id?>"
                             style="opacity: .3">
                            <span class="fa fa-trash"></span>
                        </div>

                        <div class=" tr-channel-preview">
                            <span class="tr-channel-name"><?= $c->name ?></span> <br/>
                            <a href="./index.php?r=channel/watch&id=<?= $c->id ?>">
                                <span class="tr-badge-k badge badge-primary"
                                    <strong>watch</strong>
                                </span>
                            </a>

                            <a href="./index.php?r=channel/config&id=<?= $c->id ?>">
                                <span class="tr-badge-k badge badge-primary">
                                    <span class="fa fa-cog"></span>
                                </span>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>

<?php
$js = <<<JS
requirejs(['jquery', 'trender/app', 't/zchannel'], function ($, app, zchannel) {
    $(".tr-channel-delete").on("click", function () {
        var self=this;
        var channelId=$(this).attr("data-channel-id");
        if (!confirm("Are you sure to delete this?")) return;
        zchannel.delete(channelId)
        .then(function(){
            $(self).parent().remove();
        })
    });
});
JS;
$this->registerJs($js);

