<?php
use app\models\DateUtils;
use app\models\Utils;
use yii\helpers\Html;

$category = Html::encode(Utils::category($post));
if (isset($post->collections) && !empty($post->collections))
    $liked = array_search('likes', $post->collections) !== false;
else
    $liked = false;

$data = json_decode($post->data);
// XXX: work on this
$minutes = rand(10,60);
$seconds = rand(10,60);
$time = "$minutes:$seconds";

?>

<div class="tr-post col-md-11" id="tr-post-<?= $post->id ?>">
    <div class="row">
        <!--
         <div class="tr-post-image col-md-1">
            <a class="cb" 
               href="<?= $post->link; ?>" 
               style="width:50px; height: 50px;"
               title="Profile picture of <?= $post->authorName ?>">

            </a>
        </div>
        -->
        <div class="col-md-11">
            <div class="tr-post-info">
                <img src="static/img/youtube-small.ico"  />

                <h4 class="tr-author">
                    <span>
                        <strong> 
                            <a href="javascript:void(0)">
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

        <div class="col-md-12" style="margin-top: 5px;margin-bottom: 5px;">
            <div class="col-md-10" style="padding-top:6px;padding-bottom:7px;background-color: #000">
                <span class="fa fa-play tr-video-miniplayer"></span>
                <img data-picture="<?= $post->picture ?>"
                     data-postid="<?= $post->id ?>"
                     data-cached="<?= @$post->cached ?>"
                     id="img-<?= $post->id ?>"
                     src="<?= Utils::cached($post); ?>"
                     class="tr-cache-it youtube-img"
                     alt="loading..."
                     style="font-size: 8px"
                />
                <span class="tr-video-time video-time"><?= $time ?></span>
            </div>
        </div>
    </div>

    <div class="row tr-post-details">
        <div class="col-md-12">
            <div>
                <p style="margin:0px;color: gray;font-size:12px;">
                    <span class="fa fa-clock-o"></span>
                    <?= $post->timestampFmt ?>
                    <span aria-hidden="true">· </span>
                    <a href="<?= $post->link ?>" target="__blank">
                      watch on youtube
                    </a>
                </p>

                <a href="javascript:void(0)" 
                   data-tx-op="<?= $liked?'remove':'add'?>"
                   data-tx-postid="<?= $post->id ?>"
                   data-tx-collection="likes"
                   class="tx-like">
                        <?php if (!$liked): ?>
                            <img style="display:inline-block;padding:0px;width:13px" 
                            src="static/img/like.png"  />
                            Like
                        <?php else: ?>
                            <span class="tx-liked">Liked</span>
                        <?php endif; ?>
                </a>

                <?php if (!empty($cols)):  ?>
                <span aria-hidden="true">
                    <div class="tr-dropdown-inline dropdown">
                        <a href="#" data-toggle="dropdown" 
                           aria-expanded="true">
                            <strong>· </strong>
                            add to
                        </a>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <?php foreach ($cols as $c): ?>
                        <?php $belongs = array_search($c->name, $post->collections) !== false; ?> 
                        <li role="presentation">                            
                            <a role="menuitem" tabindex="-1" href="#">
                                <?= $belongs ? "<strong>{$c->label}</strong>" : $c->label; ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                      </ul>
                    </div>
                </span>
                <?php endif; ?>

                <span aria-hidden="true">
                    <a href="javascript:void(0)">
                        <strong>· </strong>
                        <?= $data->likes ?> likes
                    </a>
                </span>

                <a href="#" class="pull-right tr-cat-link"
                   title="<?= implode(',', $post->category) ?>">
                    <strong>
                    <?= $category ?>
                    </strong>
                </a>
            </div>
        </div>
    </div>
</div>
