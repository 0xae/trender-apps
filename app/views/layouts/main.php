<?php 

function renderPlugin($plugin, $params=[]) {
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/$plugin.php",
        $params
    ); 
}

require_once "fb_layout.php"; 
?>
