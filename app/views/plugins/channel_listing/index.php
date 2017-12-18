<?php 
use yii\helpers\Url;
use app\models\Utils;
// XXX: do some stuff here 
?>

<?php foreach($channels as $c): ?>

<div class="col-md-3">
    <div class="thumbnail tx-channel-thumb">
        <img class="tx-thumb-logo" src="<?= Utils::cached($c->collections[0]->posts[0]) ?>" alt="...">
        <div class="caption">
            <h3><?= $c->name ?></h3>
            <p style="margin:0px;padding:0px;">
                <a href="<?= Url::to(["channel/watch", 'id'=>$c->id]) ?>" 
                   class="btn btn-primary" role="button">
                    open
                </a>

                <a href="<?= Url::to(["channel/subscribe", 'id'=>$c->id]) ?>" 
                   class="btn btn-danger" role="button">
                    subscribe
                </a>
            </p>
        </div>
    </div>
</div>

<?php endforeach; ?>