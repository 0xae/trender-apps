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
?>

<div class="col-md-12">
    <div class="">
        <h4 class="">
            <span style="color: crimson;" 
                 class="glyphicon glyphicon-facetime-video"></span>&nbsp;
            Featured video
        </h4>
    </div>

    <div id="tr-outdoor-img">
        <div class="tr-main-badge" 
             style="position: absolute;top: 140px;left: 40%;">
            <span class="fa fa-play"></span> Play video
        </div>
        <img src="../<?=$post->cached?>" />
    </div>

    <!--
    <iframe id="ytplayer" type="text/html" 
          width="406" height="200"
          v-if="isPlaying"
          v-bind:src="playUrl"
          frameborder="0">        
    </iframe>
    -->    

    <div id="tr-featured-content">
        <div>
            <h4 class="tr-author" style="display: inline;font-size: small">
                <span>
                    <img src="static/img/youtube-small.ico" width="15px" />
                    
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
                        · <?=  $post->timestamp ?>
                    </strong>
                </span>
            </div>

            <div class="tr-post-description" style="margin-left: 0px;">
                <p style="font-size: 12px;"> <?= $post->description ?> </p>
            </div>
        </div>

        <!--
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


        <ul class="list-unstyled featured-youtube-post">
            <li>
                <span class="fa fa-thumbs-up"></span>
                <?= $json->likes ?>
            </li>

            <li>
                <span class="fa fa-street-view"></span>
                <?= $json->views ?>
            </li>

            <li>
                <span class="fa fa-clock-o"></span>
                <span style="font-size: 11px;">
                <strong >
                    <?php 
                         DateUtils::formatToHuman($post->timestamp);
                    ?>           
                </strong>
                </span>
            </li>
        </ul>
        -->
    </div>
</div>
