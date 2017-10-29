<?php
use app\models\DateUtils;
use app\models\Utils;
$data = json_decode($post->data);
$minutes = rand(10,60);
$seconds = rand(10,60);
$time = "$minutes:$seconds";
?>

<div class="tr-post col-md-8" id="tr-post-<?= $post->id ?>">
    <div class="row tr-youtube-post">
        <div class="tr-youtube-preview col-md-3">
            <span class="fa fa-play tr-video-miniplayer"></span>
            <img src="<?= Utils::cached($post) ?>" 
                 id="img-<?= $post->id ?>"
                 alt="loading..."
                 style="font-size: 8px"
            />
            <span class="tr-video-time"><?= $time ?></span>
        </div>

        <div class="col-md-8" style="padding-left: 0px;">
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

            <div class="tr-youtube-link">
                <a href="<?= $post->link ?>">
                    <p> 
                        <?= str_replace('https://', '', $post->link) ?> 
                    </p>
                </a>
            </div>
        </div>
    </div>
</div>
