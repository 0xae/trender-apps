<div class="col-md-12 tr-newsfeed" style="">
    <div class="col-md-6">
        <!-- group -->
        <?php foreach ($groups as $g): ?>
            <div class="tr-post-group" id="<?= $g['posts'][0]->id ?>">
                <div class="tr-group-header">
                    <span class="tr-group-title">
                        <?= $g['label'] ?>
                    </span>
                    <span class="tr-group-descr">
                         2017-10-12 · 
                         <?= $g['score'] ?> posts
                    </span>
                </div>

                <?php
                    foreach ($g['posts'] as $post) 
                        render_post($post, $cols);
                ?>
            </div>
        <?php endforeach; ?>

        <!-- post -->
        <?php foreach ($posts as $post) 
                render_post($post, $cols); 
        ?>
    </div>

    <div class="col-md-3 rs-pad tr-newsfeed-col">
        <div class="content">
        <h4>Sugestions</h4>
        </div>
    </div>

    <div class="col-md-3 rs-pad tr-newsfeed-col" style="border-left: 1px solid #ddd">
        <div class="content">
        <h4>Trending</h4>
        </div>
    </div>
</div>

<?php
$script = <<<JS
requirejs(["trender/app", "jquery", "_", "t/zpost"], 
function (app, $, _, zpost){
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
