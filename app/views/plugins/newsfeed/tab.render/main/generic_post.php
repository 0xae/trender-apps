<?php
use app\models\DateUtils;
use app\models\Utils;
use app\models\Trender;
use yii\helpers\Html;

$category = Html::encode(Utils::category($post));
if (isset($post->collections) && !empty($post->collections))
    $liked = array_search('likes', $post->collections) !== false;
else
    $liked = false;
?>

<div class="tr-post col-md-12" id="tr-post-<?= $post->id ?>">
    <div class="row">
         <div class="tr-post-image col-md-1">
            <a class="cb" 
               href="<?= $post->link; ?>" 
               style="width:50px; height: 50px;"
               title="Profile picture of <?= $post->authorName ?>">

                <img data-picture="<?= $post->picture ?>"
                     data-postid="<?= $post->id ?>"
                     data-cached="<?= @$post->cached ?>"
                     src="<?= Utils::cached($post); ?>"
                     id="img-<?= $post->id ?>"
                     class="tr-cache-it"
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
    </div>

    <div class="row tr-post-details">
        <div class="col-md-12">
            <div>
                <p style="margin:0px;color: gray;font-size:12px;">
                    <span class="fa fa-clock-o"></span>
                    <?= $post->timestampFmt ?>
                    <span aria-hidden="true">· </span>
                    <?= $post->source ?>
                    <span aria-hidden="true">· </span>
                    <?= $post->location ?>
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
                        0 reactions
                    </a>
                </span>

                <span aria-hidden="true">
                    <a href="<?= $post->link; ?>">
                        <strong>· </strong>
                        full story
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
