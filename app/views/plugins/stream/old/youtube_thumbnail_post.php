<?php
use app\models\DateUtils;
use app\models\Utils;
$data = json_decode($post->data);

// XXX: work on this
$minutes = rand(10,60);
$seconds = rand(10,60);
$time = "$minutes:$seconds";
?>

<div class="tr-post col-md-8" id="tr-post-<?= $post->id ?>">
    <div class="row">
        <div class="tr-youtube-preview col-md-3">
            <span class="fa fa-play tr-video-miniplayer"></span>
            <img src="<?= Utils::cached($post) ?>" 
                 id="img-<?= $post->id ?>"
                 alt="loading..."
                 style="font-size: 8px"
            />
            <span class="tr-video-time"><?= $time ?></span>
        </div>
    </div>
</div>
