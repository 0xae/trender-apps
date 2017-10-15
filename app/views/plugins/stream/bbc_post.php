<?php
use app\models\DateUtils;
$picture = $post->cached;
?>

<div role="article" class="dg di ds" id="tr-post-<?= $post->id ?>">
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
                     alt="loading..."
                     style="font-size: 9px"
                     v-tx-img-cache="{post: post}"
                />
            </a>
            </center>            
        </div>
        <div style="">
            <h3 class="dt dm" style="display: inline-block;letter-spacing: 2px">
                BBC
            </h3>
            <div style="color: gray;display:inline;">
                <span style="font-size: 11px;">
                    <strong>
                        · <?= 
                            DateUtils::youtubeFmt($post->timestampFmt) 
                        ?>   
                    </strong>
                </span>
            </div>
        </div>
    </div>
    <div class="du" style="">
        <span> <p> <?= $post->description ?> </p> </span>
    </div>
</div>


<div class="el">
    <div class="k cv">
        <a href="javascript:void(0)" v-on:click="like(post)">
            <img style="display:inline-block;padding:0px;" 
                 src="static/img/like.png" 
                 width="13" 
                 height="13" 
                 class="o"
            />                
        </a>
        <a href="javascript:void(0)" v-on:click="like(post)">like</a>
        <span aria-hidden="true">· </span>
        <a href="<?= $post->link; ?>">full Story</a>
    </div>
</div>

</div>

