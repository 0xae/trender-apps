<?php
    foreach ($posts as $post) {
        echo \Yii::$app->view->renderFile(
            "@app/views/plugins/youtube_stream/youtube_mini.php", 
            ["post" => $post]
        );
    };
?>

