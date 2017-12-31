<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Utils;
use app\models\PrettyDate;

foreach($channels as $c):
$fmt = str_replace('T', ' ', $c->lastUpdateFmt);
$last_update = new DateTime($fmt);
?>

<div class="col-md-3 rs-pad">
    <div class="thumbnail tx-channel-thumb" style="background: url(<?= Utils::cached($c->collections[0]->posts[0]) ?>) no-repeat;background-color:#000;background-size:cover;">
        <!-- <img class="tx-thumb-logo" 
             src="<?= Utils::cached($c->collections[0]->posts[0]) ?>" 
             alt="<?= Html::encode($c->collections[0]->posts[0]->description) ?>"
        /> -->

        <div class="tx-thumb-img-descr">
            <a href="<?= Url::to(["channel/subscribe", 'id'=>$c->id]) ?>" 
                class="btn btn-sm tx-btn btn-danger pull-right" 
                style="margin-top: 5px;"
                role="button">
                subscribe
            </a>

            <a href="<?= Url::to(["channel/watch", 'id'=>$c->id]) ?>" 
                class="" role="button">
                <h3><?= $c->name ?></h3>
            
            </a>

            <span title="<?= $c->lastUpdateFmt ?>">
                <i class="fa fa-clock-o"></i>
                <?= PrettyDate::parse($last_update) ?> 
            </span>

        </div>
    </div>
</div>
<?php endforeach; ?>
