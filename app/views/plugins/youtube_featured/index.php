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
    <span class="glyphicon glyphicon-facetime-video"
          style="color: red;padding-top:0px;"></span>

    <h4 class="tr-section-title">
        Featured Video
    </h4>

    <!--
    <?php if ($category) : ?>
    <div class="dropdown pull-right">
        <span class="tr-link tr-badge-k dropdown-toggle badge"
              data-toggle="dropdown" aria-expanded="true"
              id="dropdownMenu1">

            <?= $category ?>

            <span style="font-size:9px;" 
                 class="glyphicon glyphicon-cog"></span>
        </span>

        <ul class="dropdown-menu" style="font-size: 12px;" role="menu"  aria-labelledby="dropdownMenu1">
            <li role="presentation">
                <a role="menuitem" tabindex="-1" href="#">option 1</a>
            </li>
            
            <li role="presentation" class="divider"
                style="margin-bottom: 4px;">
            </li>

            <li role="presentation">
                <a role="menuitem" tabindex="-1" 
                    href="./index.php?r=home/index&q=<?=urlencode($category)?>"
                    title="Search for '<?= $category; ?>'">
                    <span class="fa fa-search"></span>
                    &nbsp;
                    <strong><?= $category; ?></strong>
                </a>
            </li>
        </ul>
    </div>
    <?php endif; ?>
    -->

    <div class="tr-section-content">
        <div style="" class="tr-featured-video">
            
            <div id="tr-outdoor-img">
                <div class="tr-main-badge">
                    <span class="fa fa-play"></span> Play video
                </div>
                <img src="<?=Utils::cached($post); ?>" />
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
</div>

-->    


