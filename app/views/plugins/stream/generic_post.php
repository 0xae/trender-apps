<?php
use app\models\DateUtils;
use app\models\Utils;
use app\models\Trender;
$category = Utils::category($post);
?>

<div class="tr-post col-md-12" id="tr-post-<?= $post->id ?>">
    <div class="row">
         <div class="tr-post-image col-md-1">
            <a class="cb" 
               href="<?= $post->link; ?>" 
               style="width:50px; height: 50px;"
               title="Profile picture of <?= $post->authorName ?>">

                <img data-xsrc="<?= Utils::cached($post) ?>" 
                     id="img-<?= $post->id ?>"
                     width="50"
                     height="45"
                     alt="loading..."
                     style="font-size: 8px"
                />
            </a>
        </div>

        <div class="col-md-10">
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
            </div>

            <div class="tr-post-description">
                <p> <?= $post->description ?> </p>
            </div>
        </div>
    </div>

    <div class="row tr-post-details">
        <div class="col-md-12">
            <p>
                <span style="color: gray;font-size:12px;" 
                     title="<?= $post->timestampFmt ?>">
                        <?=  $post->timestampFmt ?>
                <span aria-hidden="true">· </span>
                <?= $post->location ?>
                <span aria-hidden="true">· </span>
                <?= $post->source ?>
                </span>
            </p>

            <p>
                <a href="javascript:void(0)" 
                   title="Like this post" class="">
                    <img 
                        style="display:inline-block;padding:0px;" 
                        src="static/img/like.png" 
                        width="13" 
                        height="13" 
                        class="o" />
                    Like this
                </a>
                <span aria-hidden="true">· </span>
                <a href="javascript:void(0)">0 likes</a>
                <span aria-hidden="true">· </span>
                <a href="./index.php?r=feed/more">more</a>
                <span aria-hidden="true">· </span>
                <a href="<?= $post->link; ?>">full story</a>

                <a href="<?= $post->link; ?>" class="pull-right tr-cat-link">
                    <strong>
                    <?= $category ?>
                    </strong>
                </a>
            </p>
        </div>
    </div>
</div>

<?php
$script = <<JS
requirejs(["trender/app", "jquery", "_"], function (app, $, _){

});
JS;
