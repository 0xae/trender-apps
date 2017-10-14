<?php
    $buf = "";
    foreach ($posts as $post) {
        if ($post->type == "youtube-post") {
            $tpl = "@app/views/plugins/stream/youtube_post.php";
        } else {
            $tpl = "@app/views/plugins/stream/post.php";        
            $json = json_encode($post);
            $buf .= "
                new Vue({
                    el: '#tr-post-{$post->id}',
                    data:{
                        post: $json
                    }
                });
            ";
        }

        echo \Yii::$app->view->renderFile(
            $tpl, ["post" => $post]
        );
    }
?>

<?php
$scrip = <<<JS
requirejs(['trender/timeline', 'vue', 'trender/builtins'], 
function (Timeline, Vue) {{$buf}});
JS;
$this->registerJs($scrip);
?>

