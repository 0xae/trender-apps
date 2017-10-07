<?php
$picture = ($post->cached == "none") ?  $post->picture : $post->cached;
$from = "cache";
if ($post->cached == "none")  {
    $from = "web";
} else {
    $data = json_decode($post->cached);
    $picture = '../downloads/' . $data[0];
}
?>

<div role="article" class="dg di ds">
<div>
   <span class="" style="background-color: #dddfe2 !important;padding: 3px;border-radius:7px;padding-bottom:1px;padding-top:1px;color: #999;">
            <a href="javascript:void(0)"> <?= $from ?>  </a>
    </span>
    <div>
        <div class="by bz ca" style="width:50px;float: left; margin-right: 5px;margin-top:5px;">
            <a class="cb" 
               href="<?= $post->link; ?>" 
               style="width:50px; height: 50px;"
               title="Profile picture of <?= $post->authorName ?>">
                <img src="<?= $picture ?>" 
                     width="50" 
                     height="50" 
                     class="" 
                     alt="Post Picture">
            </a>
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
        <div class="k cv"> <abbr><?= $post->timestamp ?></abbr> </div>
        <div class="k cv">
            <a class="" aria-label="" href="<?= $post->link; ?>">
                <img style="display:inline-block;padding:0px;" src="static/img/like.png" width="13" height="13" class="o">
                <?= 10 + (int)$post->id; ?>
            </a>
            <span aria-hidden="true">· </span>
            <a href="<?= $post->link; ?>">Like</a>
            <span aria-hidden="true">· </span>
            <a href="<?= $post->link; ?>">Full Story</a>
        </div>
    </div>
</div>
</div>
