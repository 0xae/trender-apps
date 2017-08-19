<?php
$this->title = 'Trender Home';

function renderPlugin($plugin, $params=[]) {
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/$plugin.php",
        $params
    ); 
}

?>

<div ng-controller="HomeController">
    <div class="row tr-header" style="">
        <div class="col-md-12">
             <div class="tr-outside tr-header" style="height:250px">
                <div class="tr-inside" style="height:150px;">
                </div>
            </div>
        </div>
    </div><!-- /.row -->

    <div class="col-md-12">
        <?php echo \Yii::$app->view->renderFile(
                "@app/views/plugins/navbar.php", []
            ); 
        ?>
    </div>

    <div class="row" style="background-color: #f1f0f0">
        <div class="col-lg-3" style="padding:10px;">
            <div class="" style="margin-bottom: 20px;background-color: #fff;">
                <?php renderPlugin('twitch_widget'); ?>
            </div>
        </div>

        <div class="col-lg-5" style="margin-top: 10px;min-height:800px;background-color: #fff;padding-top:15px;border:1px solid #e1e6ea;border-top: 0px;">
            <div class="row" id="trender_timeline">
                <?php foreach ($posts as $post): ?>
                    <div class="" style="border-bottom: 1px solid #f5eeee;padding:15px;padding-top:10px;">
                        <?php 
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
                        ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-md-3" style="padding: 10px;padding-right:0px;">
            <div class="" style="background-color: #fff;margin-bottom:10px;">
                <?php renderPlugin('coins_widget'); ?>
            </div>

            <div class="" style="margin-bottom: 30px;">
                <?php renderPlugin('bitcoin_newsfeed'); ?>
            </div>
        </div>
    </div>

    <?= renderPlugin('webpage_plugin'); ?>
</div>
