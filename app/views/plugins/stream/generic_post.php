<?php
use app\models\DateUtils;
$picture = $post->cached;
$data = json_decode($post->data);
?>

<div class="tr-post row rs-row" id="tr-post-<?= $post->id ?>">
    <div class="tr-post-image col-md-1">
        <center>
        <a class="cb" 
           href="<?= $post->link; ?>" 
           style="width:50px; height: 50px;"
           title="Profile picture of <?= $post->authorName ?>">

            <img src="../<?= $post->cached ?>" 
                 id="img-<?= $post->id ?>"
                 width="50"
                 height="50"
                 alt="loading..."
                 style="font-size: 9px"
            />
        </a>
        </center>            
    </div>

    <div class="col-md-5">
        <div class="tr-post-info">
            <h4 class="tr-author">
                <span>
                    <strong> 
                        <a href="index.php?r=profile/index&username=<?=$post->authorName?>">
                            <?= $post->authorName ?>
                        </a>
                    </strong>
                </span>
            </h4>
            <div style="color: gray;display:inline;">
                <span style="font-size: 11px;">
                    <strong>
                        · <?=  $post->timestampFmt ?>
                    </strong>
                </span>
            </div>
        </div>

        <div class="tr-post-description">
            <p> <?= $post->description ?> </p>
        </div>
    
        <div class="tr-post-details">
            <a href="javascript:void(0)" @click="like(post)">
                <img 
                    style="display:inline-block;padding:0px;" 
                    src="static/img/like.png" 
                    width="13" 
                    height="13" 
                    class="o" />
                0
            </a>
            <span aria-hidden="true">· </span>
            <a href="javascript:void(0)">like</a>
            <span aria-hidden="true">· </span>
            <a href="<?= $post->link; ?>">full story</a>
        </div>
    </div>
</div>
