<div class="col-md-10" style="background-color: #ddd;">
    <div class="col-md-7">
        <!-- group -->
        <?php foreach ($group as $g): ?>
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

    <div class="col-md-3 rs-pad">
    </div>
</div>

<!--
<div class="col-md-2 rs-pad tr-coll-right-bar pull-right">
    <div id="topicsAffix" class="affix" data-spy="affix">
        <h4 class="tr-section-title">
            Topics
        </h4>

        <div class="tr-section-content">
            <ul class="list-unstyled">
                <?php foreach ($group as $g): ?>
                    <li class="tr-group-link">
                        <a href="#<?= $g['posts'][0]->id ?>" class="tr-more-item">
                            #<?= $g["label"] ?>
                        </a>
                        <p>
                            <?= $g["score"] ?> posts
                        </p>
                   </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>
-->

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
