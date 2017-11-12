<?php
use app\models\DateUtils;
use app\models\Utils;
use app\models\Trender;
$category = Utils::category($post);
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

            <div>
                <a href="javascript:void(0)" 
                   data-tx-op="<?= $liked?'remove':'add'?>"
                   data-tx-postid="<?= $post->id ?>"
                   data-tx-collection="likes"
                   class="tx-like">
                        <?php if (!$liked): ?>
                            <img style="display:inline-block;padding:0px;width:13px" 
                            src="static/img/like.png"  />
                            Like this
                        <?php else: ?>
                            <span class="tx-liked">Liked</span>
                        <?php endif; ?>
                </a>

                <span aria-hidden="true">· 
                    <div class="tr-dropdown-inline dropdown">
                        <a href="#" data-toggle="dropdown" 
                           aria-expanded="true">
                            add to
                        </a>
                      <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
                        <li role="presentation">
                            <a role="menuitem" tabindex="-1" href="#">collection 1</a>
                            <a role="menuitem" tabindex="-1" href="#">collection 2</a>
                            <a role="menuitem" tabindex="-1" href="#">collection 3</a>
                        </li>
                      </ul>
                    </div>
                </span>

                <span aria-hidden="true">
                    ·
                    <a href="javascript:void(0)">0 reactions</a>
                </span>

                <span aria-hidden="true">· 
                    <a href="<?= $post->link; ?>">full story</a>
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
