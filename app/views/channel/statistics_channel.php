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
                <h1>No content in statistics for now!</h1>
            </div>
        </div>
    </div>
</div>
