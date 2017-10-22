<?php
    $buf = '';
    foreach ($posts as $post) {
        echo \Yii::$app->view->renderFile(
            "@app/views/plugins/youtube_stream/youtube_mini.php", 
            ["post" => $post]
        );

        $data = json_decode($post->data);
        $json = json_encode($post);
        $pic = "https://img.youtube.com/vi/{$data->video_id}/0.jpg";
        $buf .= "Timeline.miniYoutube('#tr-post-{$post->id}', $json, '$pic');";
    };

$scrip = <<<JS
requirejs(['trender/timeline'], function (Timeline){
$buf
});
JS;

$this->registerJs($scrip);
?>

