<?php
foreach ($posts as $post) {
    $tpl = "@app/views/plugins/stream/generic_post.php";        

    echo \Yii::$app->view->renderFile(
        $tpl, ["post" => $post]
    );   
    $json = json_encode($post);
}