<?php
use app\models\DateUtils;
use app\models\Utils;

if ($post->data) {
    $json = json_decode($post->data);
} else {
    $json = new stdClass;
    $json->likes = "";
    $json->views = "";
    $json->video_id = "";
}

$pic = "https://img.youtube.com/vi/{$json->video_id}/0.jpg";

if (!isset($post->cached)) {
    $post->cached = $post->picture;
}

$cached = json_decode($post->cached);
if (is_array($cached)) {
    $url = 'downloads/' . $cached[0];
} else {
    $url = $cached;
}

$picture = $post->cached;
$data = json_decode($post->data);
$category = Utils::category($post);
?>

<div class="tr-section tr-featured-video">
    <img src="static/img/youtube-small.ico" width="17px" />
    <h4 class="tr-section-title">
        <?= $post->authorName ?>
    </h4>

    <div class="tr-section-content">
        <div style="" class="tr-featured-video">            
            <div id="tr-outdoor-img">
                <div class="tr-main-badge">
                    <span class="fa fa-play"></span> Play
                </div>
                <img src="<?=Utils::cached($post); ?>" />
            </div>

        <div class="tr-post-description" style="margin-left: 0px;">
            <p style="font-size: 11px;margin-top:-13px;"> <?= $post->description ?> </p>
        </div>

        </div>
    </div>
</div>

<!--
<iframe id="ytplayer" type="text/html" 
      width="406" height="200"
      v-if="isPlaying"
      v-bind:src="playUrl"
      frameborder="0">        
</iframe>
-->    
