<?php
use yii\helpers\Html;
$groups = $col->groups;
$posts = $col->posts;
?>

<div class="col-md-12 tr-newsfeed" style="">
    <div class="col-md-6">
        <!-- group -->
        <?php foreach ($groups as $g): ?>
            <div class="tr-post-group" id="<?= $g['posts'][0]->id ?>-group">
                <div class="tr-group-header">
                    <span class="tr-group-title">
                        <?= Html::encode($g['label']) ?>
                    </span>
                    <span class="tr-group-descr">
                         2017-10-12 · 
                         <?= $g['score'] ?> posts
                    </span>
                </div>

                <?php
                    foreach ($g['posts'] as $post) 
                        render_post($post, []);
                ?>
            </div>
        <?php endforeach; ?>

        <!-- post -->
        <?php foreach ($posts as $post) 
                render_post($post, []); 
        ?>
    </div>

    <?php
        $tpl="@app/views/plugins/channel_preview/index.php";
        echo \Yii::$app->view->renderFile($tpl, [
            'channel' => $channel,
            'feed' => $feed
        ]);
    ?>
</div>

<?php
$script = <<<JS
requirejs(["trender/app", "jquery", "_", "t/zpost"], 
function (app, $, _, zpost) {
    $(".tr-cache-it").each(function (){
        var self = this;
        var postId = $(this).attr("data-postid");
        var cached = $(this).attr("data-cached").trim();
        cached = cached.replace("[", "");
        cached = cached.replace("]", "");
        cached = cached.replace("\"", "");      

        if (!cached || cached=="none" || cached=="<uk>") {
            refetchImg();
        } else {
            var url=app.media() + "/media/" + cached;
            $.get(url)
            .then(function () {
                $(self).attr("src", url);
            }, function(){
                refetchImg();
            });
        }

        function refetchImg() {
            return zpost.downloadPic(postId)
            .then(function (data) {
                var url = app.media() + data;
                $(self).attr("src", data);
            }, function (error){
                // console.warn(error);
            });
        }
    });
});
JS;
$this->registerJs($script);