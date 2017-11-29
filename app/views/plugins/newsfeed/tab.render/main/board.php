<?php
$featured_video = $feed['featured_video'];
?>

<div class="col-md-5 rs-pad tr-newsfeed-board pull-right">
    <div class="row rs-row">
        <div class="col-md-12">
            <div>
                <h4 class="tr-channel-name">
                    <?= $channel->name ?>
                </h4>
                <p class="tr-channel-descr">
                    <?= $channel->description ?>
                </p>
            </div>
        </div>

        <!-- right now -->
        <div class="col-md-6">
            <div class="tr-section">
                <h4 class="tr-section-title">
                    Right now
                </h4>

                <div class="tr-section-content">
                    <ul class="list-unstyled">
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               l1
                            </a>
                        </li>
                    </ul>
                </div>                
            </div>            
        </div>

        <!-- featured video -->
        <?php if ($featured_video): ?>
        <div class="col-md-6">
            <?php
                echo \Yii::$app->view->renderFile (
                    "@app/views/plugins/youtube_featured/index.php",
                    ["post" => $featured_video]
                );
            ?>
        </div>
        <?php endif; ?>

        <!-- suggestions -->
        <div class="col-md-6">
            <div class="tr-section">
                <h4 class="tr-section-title">
                    Suggested Channels
                </h4>

                <div class="tr-section-content">
                    <ul class="list-unstyled">
                        <li>
                            <a href="./index.php?r=channel/watch&id="
                               class="tr-more-item">
                               l1
                            </a>
                        </li>
                    </ul>
                </div>                
            </div>            
        </div>

    </div>
</div>
