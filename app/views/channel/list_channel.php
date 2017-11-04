<?php
$count = count($data);
$left = 48 - $count;
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
            "@app/views/channel/menu_channel.php", []
        );
    ?>
    </div>

    <div class="col-md-10" style="padding: 0px;min-height: 600px;background-color: #f7f3f3;">
        <div class="row rs-row" style="height: 400px;">

            <div class="col-md-12" style="padding: 0px;">
                <?php foreach ($data as $c): ?>
                    <div class="col-md-2" style="margin:0px;padding:0px;" title="Channel <?= $c->name ?>">
                        <div class="tr-channel-panel tr-link" style="height:100px">
                            <span class="tr-channel-name"><?= $c->name ?></span> <br/>
                            <span style="font-size: 12px;">
                                <a style="text-decoration:underline;" href="./index.php?r=channel/update&id=<?= $c->id ?>">View</a>
                                <a style="text-decoration:underline;" href="./index.php?r=channel/update&id=<?= $c->id ?>">Edit</a>
                            </span>
                        </div>
                    </div>
                <?php endforeach; ?>

                <?php for ($i=0; $i < $left; $i++): ?>
                    <div class="col-md-2 tr-channel-panel-unactive" 
                         style="margin:0px;padding:0px;">
                        <div class="tr-channel-panel tr-link" style="height:100px;background-color: #f7f3f3">
                            <?php if ($audience == 'public'): ?>
                            <span class="glyphicon glyphicon-globe"></span>
                            <?php else: ?>
                            <span class="glyphicon glyphicon-lock"></span>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</div>
