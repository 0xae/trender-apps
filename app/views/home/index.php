<?php
$this->title = 'Trender Home';
function renderPlugin($plugin, $params=[]) {
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/$plugin.php",
        $params
    ); 
}
?>

<div class="row tr-page-section tr-page-header">
    <div class="container">
        <div class="col-md-1">
            <h1 class="tr-logo">Trender</h1>
        </div>

        <div class="col-md-3">
          <ul class="nav navbar-nav">
            <li class="menu-link <?= (Yii::$app->controller->id == 'home')? 'active__': '' ?>">
                <a href="index.php?r=journal/index">
                   <strong>Home</strong>
                </a>
            </li>

            <li class="menu-link <?= (Yii::$app->controller->id == 'tv')? 'active': '' ?>">
                <a href="index.php?r=tv/index">
                   <strong>Live Tv</strong>
                </a>
            </li>

            <li class="menu-link <?= (Yii::$app->controller->id == 'market')? 'active': '' ?>">
                <a href="index.php?r=market/index">
                   <strong>Markets</strong>
                </a>
            </li>
          </ul>         
        </div>

        <div class="col-md-4"></div>
    </div>
</div>

<div class="row tr-page-content">
</div>


