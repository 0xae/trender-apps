<?php
    foreach ($posts as $post) {
        if ($post->type == "youtube-post") {
            $tpl = "@app/views/plugins/stream/youtube_post.php";
        } else {
            $tpl = "@app/views/plugins/stream/post.php";
        }

        echo \Yii::$app->view->renderFile(
            $tpl, ["post" => $post]
        );
    };
?>

