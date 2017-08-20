<?php
$this->title = 'Trender Home';
function renderPlugin($plugin, $params=[]) {
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/$plugin.php",
        $params
    ); 
}
?>

<div>
    <div class="row" style="background-color: #f1f0f0">
        <div class="col-lg-3" style="padding:10px;margin-bottom: 20px;">
            <div style="background-color: #fff;">
                <?php renderPlugin('channels_widget'); ?>
            </div>

            <div class="" style="background-color: #fff;margin-top:10px;margin-bottom:10px;">
                <?php renderPlugin('coins_widget', ['showTitle' => true]); ?>
            </div>
        </div>

        <div class="col-lg-5" style="margin-top: 10px;border-radius:4px;min-height:800px;background-color: #fff;border:1px solid #e1e6ea;border-top: 0px;">
            <div class="row" id="trender_timeline" style="">
                <!--
                <div class="alert alert-success alert-new-posts" style="margin-bottom:0px;border-radius:0px;border-color:#fff;" role="alert">
                    <a href="javascript:void(0)" class="new_posts">
                        <center>View <span id="new_post_count">12 new posts</center>
                    </a>
                </div>
                -->

                <?php 
                    foreach ($posts as $post): 
                        $param = ['post' => $post];
                        if ($post["type"] == "youtube-post"):
                            renderPlugin('youtube_post', $param);
                        elseif ($post["type"] == "twitter-post"): 
                            renderPlugin('twitter_post', $param);
                        elseif ($post["type"] == "steemit-post"):
                            renderPlugin('steemit_post', $param);
                        else: 
                            renderPlugin('trender_post', $param);
                        endif; 
                    endforeach;
                ?>
            </div>
        </div>

        <div class="col-md-3" style="padding: 10px;padding-right:0px;">
        </div>
    </div>

    <?= renderPlugin('webpage_plugin'); ?>
</div>
