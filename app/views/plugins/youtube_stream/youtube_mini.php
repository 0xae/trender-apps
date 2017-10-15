<?php
use app\models\DateUtils;
$json = json_decode($post->data);
?>

<div role="article" 
     class="dg di ds youtube-post"
     id="tr-post-<?= $post->id ?>">

    <div class="tr-img-loader by bz ca">
        <div class="youtube-mini-post"
             v-on:click="select(post)"
             v-tx-img-cache="{post: post, link: link, done: done}">
            <div class="tr-shadow" style="">
                <center>
                    <div class="tr-mini-play">
                        <span class="fa fa-play" title="Play"></span>
                    </div>
                </center>

                <div style="color: #fff;margin-top:7px;">
                    <span style="margin-left:5px;">
                    </span>
                    <span class="tr-video-time">
                        <strong>
                            00:00
                        </strong>
                    </span>
                </div>
            </div>    
        </div>
    <!-- .tr-img-loader -->
    </div>

    <div class="tr-video-descr">
        <h3 class="dt dm" style="display: inline-block">
            <span>
                <strong> 
                    <a href="javascript:void(0)">
                        <?= $post->authorName ?>
                    </a>
                </strong>
            </span>
            <br/>
            <div style="color: gray">
                <span style="font-size:10px" class="fa fa-clock-o"></span>
                <span style="font-size: 11px;">
                    <strong>
                        <?= 
                            DateUtils::youtubeFmt($post->timestampFmt) 
                        ?>   
                    </strong>
                </span>
            </div>
        </h3>
    </div>
    <!-- .tr-video-descr -->
        
    <div class="du" style="padding-left: 40px;">
        <p> <?= $post->description ?> </p>
    </div>
</div>
