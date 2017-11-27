<?php
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/newsfeed/index.php", [
            "channel" => $channel,
            "collections" => $collections
        ]
    );
?>
