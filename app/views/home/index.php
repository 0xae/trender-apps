<?php
$this->title = 'Trender Home';
$imgs = [];
$perBlock = 2;
$k = 0;
$MAX=22;
$trend = 0;
$len = count($videos);

for ($i=0; $i<6; $i++){
    if ($i >= $len) {
        continue;
    }

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

<div class="container tr-container">
<div class="row" id="page_container">
    <div class="col-md-12 tr-header">
        <div class="col-md-12" style="padding: 0px;">
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
        </div>
        
        <div class="col-md-2">
        </div>

        <div class="col-md-6" id="page_tab_menu" style="padding: 0px;">
            <div role="tabpanel">

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#topStories" aria-controls="home" 
                           role="tab" data-toggle="tab">
                           Top Stories
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="#topStories" aria-controls="home" 
                           role="tab" data-toggle="tab">
                           Activity
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="#news" aria-controls="profile" 
                           role="tab" data-toggle="tab">
                           News
                        </a>
                    </li>

                    <li role="presentation">
                        <a href="#media" aria-controls="messages" 
                           role="tab" data-toggle="tab">
                           Media
                        </a>
                    </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="topStories">
                    </div>

                    <div role="tabpanel" class="tab-pane" id="news">
                    </div>

                    <div role="tabpanel" class="tab-pane" id="media">
                    </div>
              </div>
            </div>
        </div>

    </div>

    <div class="col-md-2" id="page_left_menu">
        <div class="tr-page-title">
            <h2>    
                <?= $label ?>
            </h2>
        </div>

        <div class="tr-section">
            <h4 class="tr-section-title">
                <span class="glyphicon glyphicon-flash" style="color: darkorange"></span>
                Trending topics
            </h4>

            <div class="tr-section-content">
            <ul class="list-unstyled">
                <?php for ($i=0; $i<15*2; $i+=2,$trend+=2): ?>
                    <li>
                        <a href="./index.php?r=home/index&q=<?= $trendingCats[$trend] ?>" 
                           class="tr-trend-item">
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
                        <a href="./index.php?r=home/index&q=<?= $trendingCats[$trend] ?>" 
                           class="tr-more-item">
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
                        <span class="fa fa-thumbs-up"></span>Likes
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="fa fa-star"></span>Favorites
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

    <div class="col-md-6" id="posts_container">
        <!--
        <div id="posts_loader" style="">
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
        -->
        <div id="posts_container_stream_start"></div>

        <?php
            echo \Yii::$app->view->renderFile(
                "@app/views/plugins/stream/index.php",
                ["posts" => $posts]
            );
        ?>
     <!-- #posts_container -->
    </div>
</div>
</div>

