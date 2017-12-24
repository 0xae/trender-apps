<?php 
use yii\helpers\Url;
use yii\helpers\Html;
use app\models\Utils;
use app\models\PrettyDate;
?>

<?php
foreach($channels as $c):
$last_update = new DateTime($c->lastUpdateFmt);
?>

<div class="col-md-3">
    <div class="thumbnail tx-channel-thumb">
        <img class="tx-thumb-logo" 
             src="<?= Utils::cached($c->collections[0]->posts[0]) ?>" 
             alt="<?= Html::encode($c->collections[0]->posts[0]->description) ?>"
        />

        <div class="tx-thumb-img-descr">
            <h3><?= $c->name ?></h3>
            <span title="<?= $c->lastUpdateFmt ?>">
                <i class="fa fa-clock-o"></i>
                <?= PrettyDate::parse($last_update) ?> 
            </span>
            <a href="<?= Url::to(["channel/subscribe", 'id'=>$c->id]) ?>" 
                class="btn btn-sm tx-btn btn-danger" role="button">
                subscribe
            </a>
        </div>

        <div class="caption">
            <p>
                Cum sociis natoque penatibus et magnis dis parturient montes, 
                nascetur ridiculus mus. Donec ullamcorper nulla non metus.
            </p>

            <p style="margin:0px;padding:0px;">
                <a href="<?= Url::to(["channel/watch", 'id'=>$c->id]) ?>" 
                   class="btn btn-sm tx-btn btn-warning" role="button">
                    open
                </a>
            </p>
        </div>
    </div>
</div>
<?php endforeach; ?>
