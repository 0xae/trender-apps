<?php
use yii\widgets\ActiveForm;
$controllerId = Yii::$app->controller->id;
$controllerHref = "index.php?r=feed/index";
?>

<nav class="navbar navbar-inverse tr-navbar">
<div class="container-fluid">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">
            <span class="glyphicon glyphicon-facetime-video"
                  style="color: red;padding-top:0px;"></span>
            Trender
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li class="<?= ($controllerId == 'feed') ? 'active' : '' ?>">
                <a href="./index.php?r=feed/index">Home</a>
            </li>
            <li class="<?= ($controllerId == 'live') ? 'active' : '' ?>">
                <a href="./index.php?r=live/index">Live Tv</a>
            </li>
            <li class="<?= ($controllerId == 'market') ? 'active' : '' ?>">
                <a href="./index.php?r=market/index">Markets</a>
            </li>
            <li class="<?= ($controllerId == 'explore') ? 'active' : '' ?>">
                <a href="./index.php?r=explore/index">Explore</a>
            </li>
        </ul>

        <?php $form = ActiveForm::begin(['action' => $controllerHref, 
                                         'method' => 'get',
                                         'options' => [
                                         'role' => 'search',
                                         'class' => 'navbar-form navbar-right'
                                         ]]); ?>
                <input type="text" 
                       class="form-control tr-search-input"
                       name="q"
                       value="<?= @$_GET['q'] ?>"
                       placeholder="Search for anything"
                 />
        <?php ActiveForm::end(); ?>
    </div><!-- /.navbar-collapse -->

</div><!-- /.container-fluid -->
</nav>