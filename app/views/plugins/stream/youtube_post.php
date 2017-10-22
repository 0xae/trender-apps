<?php
use app\models\DateUtils;
$json = json_decode($post->data);
?>

<div role="article" class="dg di ds youtube-post" id="tr-post-<?= $post->id ?>">
<div>
    <div>
        <div class="tr-img-loader by bz ca" 
             style="width:35px;float: left;margin-right: 5px;">
            <a class="cb" 
               href="<?= $post->link; ?>" 
               style="height: 35px;width:35px;"
               title="Profile picture of <?= $post->authorName ?>">

                <img src=""
                     id="img-<?= $post->id ?>"
                     width="35"
                     height="35"
                     style="font-size: 9px"
                     v-tx-img-cache="{post: post}"
                     alt="loading..."
                />
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
                <br/>
                <div style="color: gray">
                    <span style="font-size:10px" class="fa fa-clock-o"></span>
                    <span style="font-size: 11px;">
                        <strong>
                            <?= DateUtils::youtubeFmt($post->timestampFmt) ?>   
                        </strong>
                    </span>
                </div>
            </h3>
        </div>
    </div>
    
    <div class="du" style="padding-left: 40px;">
        <span>
            <p> <?= $post->description ?> </p> 
        </span>

        <div style="width:246px;height:138px;border-radius:1px;"
             id="yt-<?= $post->id ?>"
             v-tx-img-cache="{post: post, link: link, done: done}">
            <div class="tr-shadow" style="margin-top:6px;height:10px">
                <center>
                <!--<img width="350px" 
                     src="https://img.youtube.com/vi/
                      <?= $json->video_id ?>/0.jpg" />
                    -->

                    <div class="" 
                         style="color:red;font-size: 25px;padding-top:40px;margin-bottom: 43px;">
                        <span class="fa fa-play" title="Play"></span>
                    </div>
                </center>

            <div style="color: #fff;padding-top:6px;padding-bottom:5px;background-color: rgba(0,0,0,.7);">
                <span style="margin-left:5px;">
                    <img src="static/img/youtube-small.ico" style="float:left;margin-left:4px" />
                    <strong>
                        <?php
                         $label= substr($post->authorName, 0, 19);
                         echo (strlen($label) > 16) ? $label . '...' : $label;
                        ?>
                    </strong>
                </span>
                <span style="float: right;margin-right:5px;">
                    <strong>
                        <span class="fa fa-clock-o" style="font-size:12px"></span>
                        0:00
                    </strong>
                </span>
            </div>
            </div>    
        </div>
    </div>
</div>
</div>

