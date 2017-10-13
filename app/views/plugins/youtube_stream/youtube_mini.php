<?php
use app\models\DateUtils;
$json = json_decode($post->data);
$pic = "https://img.youtube.com/vi/{$json->video_id}/0.jpg";
?>

<div role="article" class="dg di ds youtube-post " 
     id="tr-post-<?= $post->id ?>">
<div>
    <div>
        <div class="tr-img-loader by bz ca"
             style="width:146px;float:left;margin-right: 5px;">

        <div style="width:146px;height:78px;border-radius:3px;"
             id="yt-img-<?= $post->id ?>"
             v-tx-img-cache="{post: post, link: link, done: done}"
             v-on:click="logNode"
             class="youtube-mini-post">

            <div class="tr-shadow" style="height:10px">
                <center>
                    <div style="padding-top:20px;color:red;font-size: 25px;">
                        <span class="fa fa-play" title="Play"></span>
                    </div>
                </center>

                <div style="color: #fff;margin-top:7px;">
                    <span style="margin-left:5px;">
                    </span>
                    <span class="tr-video-time"
                         
                        style="float: right;font-size:12px;margin-right:5px;background-color: rgb(0,0,0);border-radius:2px;padding-right:5px;padding-left:4px;">
                        <strong>
                            <span class=" fa fa-clock-o" style="font-size:12px"></span>
                            00:00
                        </strong>
                    </span>
                </div>
            </div>    
        </div>        

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

    </div>
    
    <div class="du" style="padding-left: 40px;">
        <span> <p> <?= $post->description ?> </p> </span>
    </div>
</div>
</div>

<?php
$scrip = <<<JS
requirejs(['trender/timeline'], function (Timeline){
    Timeline.miniYoutube('#yt-img-{$post->id}', {$post->data}, '$pic');
});
JS;
$this->registerJs($scrip);
?>
