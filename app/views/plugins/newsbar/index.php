<style>
.navbar-news {
    margin: 0px;
    padding: 0px;
    font-size: 12px;
    margin-bottom: 10px;
    border-bottom: 1px solid #f6f5f3;
    box-shadow: 0px 0px 2px rgba(0,0,0,.2);
}
.navbar-news #news-stream {
    background-color: beige;
    height: 25px;
    overflow-y: hidden;
}
.navbar-news #news-stream div.news-entry {
    border-left: 1px solid gray;
}

.news-entry-sep {
    font-weight: bold;
    color: gray;
    font-size: 15px;
}
</style>

<div class="col-md-12 navbar-news">
    <div id="news-stream">
        <?php foreach ($posts as $p): ?>
        <span class="news-entry tr-txt-11">
            <?php 
                if ($p->type == 'steemit-post') {
                    $append = '<img width="16" height="16"'.
                                ' src="static/img/steemit-196x196.png" />';
                                  
                } else if ($p->type == 'twitter-post') {
                    $append = '<img width="16" height="16"'.
                              ' src="static/img/twitter-192x192.png" />';
                } else {
                    $append = "<strong>@</strong>";
                }    
            ?>

            <span><?= $append ?><strong><?= $p->authorName ?></strong></span>
            <?= $p->description ?>
        </span>
        
        <span class="news-entry-sep"><strong>|</strong></span>
        <?php  endforeach; ?>
    <!-- -->
    </div>
</div>

<?php
$scrip = <<<JS
requirejs(['trender/app', '_', 'jquery'],
function (app, _, $) {
    console.info("component inited.");
    var i  = 1;
    
    setInterval(function () {
    //setTimeout(function () {
        $("#news-stream").css("margin-left", i-=10);
    }, 220);
});
JS;
$this->registerJs($scrip);


