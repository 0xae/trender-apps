<?php
use app\models\Post;
use app\models\Utils;
$this->title = 'Trender Home';

$imgs = [];
$perBlock = 2;
$k = 0;
$MAX=22;
$trend = 0;
$videosCount = count($videos);

for ($i=0; $i<6; $i++){
    if ($i >= $videosCount) {
        break;
    }

    $data = [];
    for ($j=0; $j<$perBlock; $j++){
        // XXX: remove this later
        do {
            $vid = @$videos[$k++];
            if (!$vid) break;
        } while (!@$vid->cached);
        if ($vid)
            $data[] = $vid;
    }
    $imgs[] = $data;
}

$links = [];
$postsCount = count($posts);
$LINK_TEXT_MAX = 45;
$MAX_LINKS_COUNT = 20;

for ($i=0; $i<$postsCount; $i++) {
    $post = $posts[$i];
    if ($i >= $MAX_LINKS_COUNT) {
        break;
    }
    
    if ($post->type == 'youtube-post') {
        continue;
    }

    $icon = '';
    $text = $post->link;
    if ($post->type == 'steemit-post') {
        $icon = 'static/img/steemit-196x196.png';
        $text = str_replace('https://steemit.com/', '', $post->link);
    } else if ($post->type == 'twitter-post') {
        $icon = 'static/img/twitter-192x192.png';
        $text = str_replace('https://twitter.com/', '', $post->link);
    }

    $href = $post->link;
    $len = strlen($href);
    $text = '/' . substr($text, 0, $LINK_TEXT_MAX);

    if ($len > $LINK_TEXT_MAX) {
        $text .= '...';
    }
        
    $links[] = [
        "href" => $href,
        "icon" => $icon,
        "text" => $text
    ];
}

$profiles = [];
$MAX_PROFILES_COUNT=20;
for ($i=0,$j=0; $i<$postsCount; $i++) {
    if ($j >= $MAX_PROFILES_COUNT) {
        break;
    }

    $post = $posts[$i];
    
    if ($post->cached != 'none' && $post->cached != '') {
        $j++;
        $profiles[] = $post;
    }
}

for ($i=0; $i<$videosCount; $i++) {
    $vid = $videos[$i];
    if (isset($vid->cached) && $vid->cached != 'none' 
              && $vid->cached != '') {
        $featuredVideo = $vid;
    }
}
?>

<div class=" tr-container">
<div class="row" id="page_container">
    <div class="tr-header">
        <div class="row rs-row" style="padding: 0px;">
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
                            <img class="tr-cover" 
                                src="<?= Utils::cached($vid) ?>" />
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endforeach; ?> 
        </div>

        <div class="row rs-row" id="page_top_menu_container">
            <div class="col-md-2">
                <div class="tr-page-title">
                    <h2>   
                        <?= $label ?>
                    </h2>
                </div>
            </div>

            <div class="col-md-7" id="page_tab_menu">
                <div role="tabpanel">
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
                    <!-- Nav tabs -->
                    </ul>

                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="topStories">
                        </div>

                        <div role="tabpanel" class="tab-pane" id="news">
                        </div>

                        <div role="tabpanel" class="tab-pane" id="media">
                        </div>
                    <!-- Tab content -->
                    </div>
                <!-- tabpanel -->
                </div>
            <!-- #page_tab_menu -->
            </div>
        
        </div>
    </div>

    <div class="col-md-2" id="page_left_menu">
        <div class="tr-section">
            <ul class="list-unstyled tr-settings" style="margin-bottom: 25px;">
                <li>
                    <a href="./index.php?r=home/index" 
                       class="tr-a" title="Go to index">
                        <span class="fa fa-home"></span>Home
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="fa fa-thumbs-up"></span>Likes 
                        &nbsp;<strong>(12K)</strong>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="fa fa-star"></span>Favorites
                        <strong>(12)</strong>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="fa fa-trash"></span>Spam
                        <strong>(+200)</strong>
                    </a>
                </li>

                <li>
                    <a href="#">
                        <span class="fa fa-cog"></span>Settings
                    </a>
                </li>
            </ul>
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
                        <a href="./index.php?r=home/index&c=<?= urlencode($trendingCats[$trend]) ?>" 
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
                        <a href="./index.php?r=home/index&c=<?= urlencode($trendingCats[$trend]) ?>" 
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
    </div>

    <div class="col-md-7" id="posts_container">
        <div id="posts_container_stream_start">
        </div>

        <div class="rs-row row" id="posts_container_stream">
            <?php
                echo \Yii::$app->view->renderFile(
                    "@app/views/plugins/stream/index.php",
                    ["posts" => $posts]
                );
            ?>
        </div>
     <!-- #posts_container -->
    </div>

    <div class="col-md-3 pull-right" id="page_right_col">
        <div class="row">
            <?php if (isset($featuredVideo)): ?>
            <!-- featured video -->
            <div class="col-md-11">
                <?php
                    echo \Yii::$app->view->renderFile (
                        "@app/views/plugins/youtube_featured/index.php",
                        ["post" => $featuredVideo]
                    );
                ?>
            </div>
            <?php endif; ?>

            <?php if (count($profiles)): ?>
            <!-- top profiles -->
            <div class="col-md-10" style="margin-bottom: 20px;">
                <h4 class="">
                    Top Profiles
                </h4>

                <?php foreach ($profiles as $p): ?>
                <div class="tr-link tr-img-block">
                    <img title="<?= "@{$p->authorName}: {$p->description}" ?>"
                         alt="<?= $p->authorName ?>"
                         src="<?= Utils::cached($p) ?>" 
                    />
                </div>
                <?php endforeach; ?>

                <br/>
                <a href="javascript:void(0)" 
                   class="tr-txt-11 tr-txt-underline">
                    See more
                </a>
            </div>
            <?php endif; ?>

            <?php if (count($links)): ?>
            <!-- top links -->            
            <div class="col-md-12">
                <h4 class="">
                    Top Links
                </h4>

                <ul class="list-unstyled">
                    <?php foreach($links as $link): ?>
                        <li>
                            <a href="<?= $link['href'] ?>" class="tr-txt-12">
                                <img src="<?= $link['icon'] ?>" 
                                   width="16" height="16"
                                   style="" /> 
                                <?= $link['text']; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php endif; ?>            
        </div>
    </div>
</div>
</div>

