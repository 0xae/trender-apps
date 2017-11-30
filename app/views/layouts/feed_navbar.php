<?php
use yii\widgets\ActiveForm;
use yii\helpers\BaseHtml;
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Login;
$model = new Login;

$controllerId = Yii::$app->controller->id;
$controllerAction = Yii::$app->controller->action;
$controllerHref = "index.php?r=feed/index";
?>

<nav class="navbar navbar-inverse navbar-fixed-top tr-navbar">
<div class="container-fluid">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?= Url::to(['feed/index']) ?>">
            <span class="glyphicon glyphicon-facetime-video"
                  style="color: red;padding-top:0px;"></span>
            Trender
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav tr-navbar-menu">
            <li class="<?= ($controllerId == 'feed' || $controllerId == 'channel' ) ? 'active' : '' ?>">
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

        <ul class="nav navbar-nav navbar-right">
            <?php if (Yii::$app->user->isGuest): ?>
            <li class="tr-signup dropdown">
                <a class="login-dropdown-toggle"       
                   style="color: #fff;padding-bottom:0px;" 
                   title="log into trender"                
                   data-toggle="dropdown" role="button"
                   aria-expanded="true">
                    <strong>
                        <span class="fa fa-user"></span> 
                        SIGN IN
                    </strong>
                </a>

                <ul class="dropdown-menu tr-login" role="menu">
                    <li style="color: gray;">
                        <div class="">
                            <h3>
                                <span class="text-primary glyphicon glyphicon-facetime-video"
                                      style="font-size:19px;padding-top:0px;"></span>
                                Sign in to trender
                            </h3>
                            <p style="font-size:12px;">The awesome newsfeed, register 
                                <a style="text-decoration:underline;font-weight:bold;padding:1px !important;" 
                                   href="<?= Url::to(['user/signup']) ?>">
                                   here
                               </a>
                            </p>
                            <?php $form = ActiveForm::begin(['action' => Url::to(['user/signin']), 'options' => ['id' => 'login-user']]); ?>
                                <?= $form->field($model, 'email')
                                          ->textInput(['placeholder' => 'Email', 
                                                       'no-autocomplete'=>'no-autocomplete']); 
                                ?>


                                <?= $form->field($model, 'password')
                                          ->passwordInput(['placeholder' => 'password']); 
                                ?>

                            <?= Html::submitButton('<strong>sign in</strong>', [
                                'class' => 'btn-sm btn btn-block btn-warning tr-btn',
                                'style' => "margin-top:14px;"
                            ]) ?>
                            <p style="font-size:11px;margin-top:4px;">
                                By using Trender you agree to these
                                <strong>
                                    <a href="#" style="padding:1px !important;color:gray;text-decoration:underline">
                                        terms</a>.
                                </strong>                                
                            </p>
                            <?php ActiveForm::end(); ?>
                        </div>
                    </li>
                </ul>
            </li>
            <?php else: ?>
            <li class="dropdown active">
                <a class="dropdown-toggle" 
                   style="color: #fff;opacity:.7;" 
                   data-toggle="dropdown" role="button" 
                   aria-expanded="true">
                    <strong>
                        <span class="fa fa-user"></span> 
                        <?= \Yii::$app->user->identity->name; ?>                    
                    </strong>
                </a>
                <ul class="dropdown-menu tr-dropdown-menu" role="menu">
                    <li class="divider"></li>
                    <li><a href="<?= Url::to(['user/signout']); ?>">Sign out</a></li>
                </ul>
            </li>
            <?php endif; ?>

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
                       value="<?= BaseHtml::encode(@$_GET['q']) ?>"
                       placeholder="Search for anything"
                 />
        <?php ActiveForm::end(); ?>
    </div><!-- /.navbar-collapse -->

</div><!-- /.container-fluid -->
</nav>