<?php
use app\models\DateUtils;
if ($post->data) {
    $json = json_decode($post->data);
} else {
    $json = new stdClass;
    $json->likes = "";
    $json->views = "";
    $json->video_id = "";
}
$pic = "https://img.youtube.com/vi/{$json->video_id}/0.jpg";
?>

<div role="article" class="dg di ds" id="tr-youtube-featured">
<div>
    <div id="tr-outdoor-img"
         v-tx-img-cache="{post: post, link: link, done: done}"
         v-on:click="playVideo(post)">
        <div class="tr-shadow">
            <center>
                <div class="tr-main-badge" style="margin-top: 100px;">
                 <span class="fa fa-play"></span> Play video
                </div>
            </center>    
        </div>
    </div>
    <div style="padding: 10px;padding-top:2px;">
        <div style="">
            <h3 class="dt dm" style="display: inline-block">
                <span>
                    <strong> 
                        <a href="javascript:void(0)">
                            <?= $post->authorName ?>
                            {{post.authorName}}
                        </a>
                    </strong>
                </span>
            </h3>
        </div>
        <div class="du" style="">
            <span> <p> <?= $post->description ?> {{post.description}} </p> </span>
        </div>

        <ul class="tr-menu featured-youtube-post">
            <li>
                <span class="fa fa-thumbs-up"></span>
                <?= $json->likes ?>
                {{post.json.likes}}
            </li>

            <li>
                <span class="fa fa-street-view"></span>
                <?= $json->views ?>
                {{post.json.views}}
            </li>

            <li>
                <span class="fa fa-clock-o"></span>
                <span style="font-size: 11px;">
                <strong>
                    <?= DateUtils::formatToHuman($post->timestampFmt) ?>            
                </strong>
                </span>
            </li>
        </ul>
    </div>

</div>
</div>
