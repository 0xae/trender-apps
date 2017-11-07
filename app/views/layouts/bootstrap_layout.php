<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\assets\AppAsset;

AppAsset::register($this);
$controllerId = Yii::$app->controller->id;
$controllerHref = "index.php?r=$controllerId/index";
$this->beginPage();
?>

<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="static/lib/bootstrap/css/bootstrap.min.css" />
    <script src="static/requirejs/jquery.js"></script>
    <script src="static/lib/bootstrap/js/bootstrap.min.js"></script>
    <?php $this->head() ?>
    <link rel="stylesheet" href="static/css/trender-app.css" />
</head>

<body>

<div class="container tr-container">
    <div class="row" id="page_container">
        <?php if (isset($this->blocks['TrNewsBar'])): ?>
        <?= $this->blocks['TrNewsBar'] ?>
        <?php endif; ?>

        <?php if (isset($this->blocks['TrHeader'])): ?>
        <?= $this->blocks['TrHeader']; ?>
        <?php else: ?>
        <div class="col-md-12" id="tr-trender">
            <div class="col-md-4" style="padding-left: 0px;">
                <ul class="list-inline" id="tr-search-opts">
                    <li class="<?= ($controllerId == 'home') ? 'active' : '' ?>">
                        <a href="./index.php?r=home/index" 
                           title="Search for everything"
                           class="no-underline">
                            All news
                        </a>
                        <span class="sep">|</span>
                    </li>

                    <li class="<?= ($controllerId == 'trending') ? 'active' : '' ?>">
                        <a href="./index.php?r=trending/index" class="no-underline"
                           title="Discover what's trending">
                           Trending
                        </a> 
                        <span class="sep">|</span>
                    </li>

                    <li class="<?= ($controllerId == 'videos') ? 'active' : '' ?>">
                        <a href="./index.php?r=tv/index" 
                           title="Videos, movies, cartoons, tv shows and more"
                           class="no-underline">
                           Videos
                        </a> 
                        <span class="sep">|</span>
                    </li>

                    <li class="<?= ($controllerId == 'markets') ? 'active' : '' ?>">
                        <a href="./index.php?r=markets/index" 
                           title="Track finance and crypto markets"
                           class="no-underline">
                           Markets
                        </a>
                    </li>

                    <li class="pull-right <?= ($controllerId == 'channel') ? 'active' : '' ?>">
                        <a href="./index.php?r=channel/index" 
                           title="administer the nuts & bolts of trender"
                           class="no-underline">
                            <span class="fa fa-cog"></span>
                           Settings
                        </a>
                    </li>
                </ul>

                <?php $form = ActiveForm::begin(['action' => $controllerHref, 'method' => 'get']); ?>
                    <div class="form-group">
                        <input id="searchBox" type="text" 
                               class="form-control"
                               name="q"
                               value=""
                               placeholder="Search for anything"
                         />
                    </div>
                <?php ActiveForm::end(); ?>
            </div>

            <div class="col-md-3 pull-right" style="margin-bottom: 10px">
                <div class="pull-right">
                    <h1 class="trender-title tr-text-orange">Trender</h1>

                    <p class="trender-description">
                        What's happening on the internet.
                    </p>

                    <p class="trender-description tr-text-gray">
                        Trender was built by 
                        <a href="https://github.com/0xae"
                           class="tr-text-orange">0xae</a>
                    </p>
                </div>
            </div>                
        <!-- #tr-trender -->
        </div>
        <?php endif; ?>

        <?php 
            $this->beginBody(); 
            echo $content;
            $this->endBody();
        ?>
    </div>
</div>
</body>

</html>
<?php $this->endPage(); ?>
