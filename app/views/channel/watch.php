<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\Html;

use app\models\Post;
use app\models\Utils;
use app\models\Collection;
use app\models\TabRender;

$this->title = 'Trender - channel ' . $feed->channel->name;
$featured_post = $feed->featured_post;
?>

<div class="row rs-row">
    <div class="col-md-2" style="background-color: #fff;">
        <div class="row">
            <div class="col-md-12 rs-pad tr-channel-info">
                <?php if ($featured_post): ?>
                <div class="tr-random">
                    <img style="" 
                         src="<?= Utils::cached($featured_post) ?>" 
                         alt="..."
                    />

                    <a href="<?= $featured_post->link ?>" target="_blank">
                        <span class="descr col-md-12">
                            <strong>
                            @<?= $featured_post->authorName ?>
                            </strong>

                            <span class="pull-right tr-rtime">
                            <strong>
                                <?= $featured_post->timestampFmt ?>
                            </strong>
                            </span>
    
                            <p class="tr-rcontent">
                                <?= $featured_post->description ?>
                            </p>
                        </span>
                    </a>
                </div>
                <?php endif; ?>

                <div class="tr-section" style="margin-top: 90px;">
                    <ul class="list-unstyled tr-settings" style="margin-bottom: 25px;">
                        <li>
                            <span>
                                <a href="#">
                                    <span class="fa fa-thumbs-up"></span>
                                </a>
                                <a href="#">Likes</a>
                            </span>
                        </li>

                        <li>
                            <span>
                                <a href="#">
                                    <span class="fa fa-star"></span>
                                </a>
                                <a href="#">My Favorites</a>
                            </span>
                        </li>
                    </ul>
                </div>
                <!-- tr-section -->

                <div class="tr-section">
                    <h4 class="tr-section-title">
                        History
                    </h4>

                    <div class="tr-section-content">
                        <ul class="list-unstyled">
                            <li>
                                <a href="<?= Url::to(['feed/index']) ?>"
                                   class="tr-more-item">
                                   Back
                                </a>
                            </li>
                        </ul>
                    </div>                
                </div>
                <!-- tr-section -->
            </div>
        </div>
    </div>

    <div class="col-md-10 tr-channel-content rs-pad">
        <div class="rs-row row" style="padding:0px;">
            <?php
                echo \Yii::$app->view->renderFile(
                    "@app/views/plugins/newsfeed/index.php", [
                        "channel" => $feed->channel,
                        "feed" => $feed
                    ]
                );
            ?>
        </div>
    </div>
</div>