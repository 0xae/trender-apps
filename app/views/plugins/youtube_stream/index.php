<?php
    $buf = '';
    foreach ($posts as $post) {
        echo \Yii::$app->view->renderFile(
            "@app/views/plugins/youtube_stream/youtube_mini.php", 
            ["post" => $post]
        );

        $json = json_decode($post->data);
        $data = json_encode($post);
        $pic = "https://img.youtube.com/vi/{$json->video_id}/0.jpg";
        $buf .= "
            Timeline.miniYoutube('#tr-post-{$post->id}', $data, '$pic');
        ";
    };
?>


<?php
$scrip = <<<JS
requirejs(['trender/timeline', 'trender/builtins'], 
function (Timeline) {{$buf}});
JS;
$this->registerJs($scrip);
?>
