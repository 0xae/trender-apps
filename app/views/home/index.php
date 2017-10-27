<?php
$this->title = 'Trender Home';
$imgs = [];
$perBlock = 2;
$k = 0;
$MAX=22;
$trend = 0;
for ($i=0; $i<6; $i++){
    $data = [];
    for ($j=0; $j<$perBlock; $j++){
        // XXX: remove this later
        do {
            $vid = $videos[$k++];
        } while(!@$vid->cached);
        $data[] = $vid;
    }
    
    $imgs[] = $data;
}
?>

<style>
.tr-header {
    background-color: #000;
    min-height: 300px;
    padding: 5px;
}

.tr-img-container {
    display: block;
    max-height: 138px;
    max-width: 195px;
}

.tr-img-container img.tr-cover {
    width: 183px;
    height: 129px;
    margin-bottom: 10px;
}

.tr-img-container small {
    font-size: 12px;
    color: #fff;
    font-weight: bold;
}

.tr-img-display {
}
</style>

<div class="container tr-container">
<div class="row">
    <div class="col-md-12 tr-header">
        <?php foreach ($imgs as $img): ?>
            <div class="col-md-2 tr-img-display">
                <?php foreach ($img as $vid): ?>
                    <div class="tr-img-container">
                        <small>
                        <img src="static/img/youtube-small.ico" width="15px" />

                         <?php 
                            echo (strlen($vid->description) >= $MAX) ? 
                                substr($vid->description, 0, $MAX) . '...' : 
                                $vid->description;
                         ?>
                        </small>
                        <img class="tr-cover" src="../<?= $vid->cached ?>" />
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
        
        <div class="col-md-12">
            <h2>Trender</h2>
        </div>
    </div>

    <div class="col-md-2" style="">
        <div class="tr-section">
            <h4 class="tr-section-title">
                <span class="glyphicon glyphicon-flash" style="color: darkorange"></span>
                Trending topics
            </h4>
            
            <div class="tr-section-content">
            <ul class="list-unstyled">
                <?php for ($i=0; $i<15*2; $i+=2,$trend+=2): ?>
                    <li>
                        <a href="#" class="tr-trend-item">
                            <?= $trendingCats[$trend] ?>
                            (<?= $trendingCats[$trend+1] ?>)
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
            </div>
        </div>

        <div class="tr-section">
            <h4 class="tr-section-title">
                More
                <!--
                    <span class="glyphicon glyphicon-flash">
                    </span>
                -->
            </h4>

            <div class="tr-section-content">
            <ul class="list-unstyled">
                <?php for ($i=0; $i<15; $i+=2,$trend+=2): ?>
                    <li>
                        <a href="#" class="tr-more-item">
                            <?= $trendingCats[$trend] ?>
                            (<?= $trendingCats[$trend+1] ?>)
                        </a>
                    </li>
                <?php endfor; ?>
            </ul>
            </div>
        </div>

        <!--
        <div class="tr-section">
            <h4 class="tr-section-title">
                <span class="glyphicon glyphicon-th-list">
                </span>
                My Channels
            </h4>
        </div>
        -->

        <div class="tr-section">
            <ul class="list-unstyled tr-settings">
                <li>
                    <a href="#">
                        <span style="color: #337ab7" class="fa fa-thumbs-up"></span>Likes
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span style="color:orange" class="fa fa-star"></span>Favorites
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="fa fa-archive"></span>History
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="fa fa-play"></span>Playlist
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="fa fa-cog"></span>Settings
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="col-md-9" style="border-left:1px solid #c5c4c4;padding-left:20px;">
            <div id="posts_container" 
                 class="dp dq dr"
                 style="padding:0px;">
                 
                <div class="ds di" 
                     id="posts_container_posts_loader" 
                     style="">
                    <div>
                        <a href="javascript:void(0)" 
                           id="posts_container_loader_div">
                            <p style="text-align: center"> 
                             <span id="posts_container_posts_count">
                                0
                             </span> new posts
                            </p>
                        </a>
                    </div>
                </div>

                <div id="posts_container_stream_start"></div>

                <?php
                    echo \Yii::$app->view->renderFile(
                        "@app/views/plugins/stream/index.php",
                        ["posts" => $posts]
                    );
                ?>
            </div>
    </div>
</div>
</div>

