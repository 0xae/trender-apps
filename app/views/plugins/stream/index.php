<?php
    $buf = '';
    foreach ($posts as $post) {
        if ($post->type == "youtube-post") {
            $tpl = "@app/views/plugins/stream/youtube_post.php";
        } else if ($post->type == "twitter-post") {
            $tpl = "@app/views/plugins/stream/twitter_post.php";
        } else if ($post->type == "steemit-post") {
            $tpl = "@app/views/plugins/stream/steemit_post.php";
        } else if ($post->type == "bbc-post") {
            $tpl = "@app/views/plugins/stream/bbc_post.php";
        } else {
            $tpl = "@app/views/plugins/stream/generic_post.php";        
        }

        echo \Yii::$app->view->renderFile(
            $tpl, ["post" => $post]
        );
        
        $json = json_encode($post);
        $buf .= "Timeline.post('#tr-post-{$post->id}', $json);";
    }

$scrip = <<<JS
requirejs(['trender/timeline','vue'], function (Timeline, Vue){
$buf
});
JS;

$this->registerJs($scrip);
?>
