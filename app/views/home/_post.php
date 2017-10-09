<?php
use app\models\DateUtils;
$picture = $post->cached;
?>

<div role="article" class="dg di ds">
<div>
    <div>
        <div class="tr-img-loader by bz ca" style="width:50px;float: left; margin-right: 5px;margin-top:5px;">
            <center>
            <a class="cb" 
               href="<?= $post->link; ?>" 
               style="width:50px; height: 50px;"
               title="Profile picture of <?= $post->authorName ?>">

                <img src="" 
                     id="img-<?= $post->id ?>"
                     width="50"
                     height="50"
                     style="font-size: 9px"
                     v-tx-img-cache="{post: post}"
                     alt="loading..."
                />
            </a>
            </center>            
        </div>
        <div style="">
            <h3 class="dt dm" style="display: inline-block">
                <span>
                    <strong> 
                        <a href="javascript:void(0)">
                            <?= $post->authorName ?>
                        </a>
                    </strong>
                </span>
            </h3>
        </div>
    </div>
    <div class="du" style="">
        <span> <p> <?= $post->description ?> </p> </span>
    </div>

    <div class="el">
        <div class="k cv">
            <a class="" aria-label="" href="<?= $post->link; ?>">
                <img style="display:inline-block;padding:0px;" src="static/img/like.png" width="13" height="13" class="o">
                <?= 10 + (int)$post->id; ?>
            </a>
            <span aria-hidden="true">· </span>
            <a href="<?= $post->link; ?>">Like</a>
            <span aria-hidden="true">· </span>
            <a href="<?= $post->link; ?>">Full Story</a>
            <span aria-hidden="true">· </span>
            <span class="fa fa-clock-o"></span>
            <span style="font-size: 11px;">
            <strong>
                <?= DateUtils::formatToHuman($post->timestampFmt) ?>            
            </strong>
            </span>
        </div>
    </div>
</div>
</div>

<?php
$json = json_encode($post);
$scrip = <<<JS
new Vue({el: "#img-{$post->id}", data:{post: $json}});
JS;

$this->registerJs($scrip);
