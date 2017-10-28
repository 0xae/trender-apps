<?php 

if (isset(Yii::$app->controller->layout) && 
    Yii::$app->controller->layout != 'main') {
    require_once Yii::$app->controller->layout . '.php';
} else {
    require_once "bootstrap_layout.php";
}

