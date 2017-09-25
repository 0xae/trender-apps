<?php
$this->title = 'Trender Home';
?>

<!-- Feed Area -->
<div class="f">
    <div id="viewport">
        <div id="objects_container" style="" ng-controller="HomeController">
            <div class="bq e" id="root" role="main">
                <div id="m_home_notice"></div>
                <div id="m_newsfeed_stream" style="background-color: #fff;">
                    <div id="m-top-of-feed"></div>
                    <div id="posts_container" class="dp dq dr" style="padding:0px;">
                        <div class="ds di" id="posts_loader" style="display:none;">
                            <a href="javascript:void(0)" id="load_more_posts">
                                <p style="text-align: center"> <span id="post_count">0</span> new posts comming... </p>
                            </a>
                        </div>

                        <?php
                            foreach ($posts as $post) {
                                echo \Yii::$app->view->renderFile(
                                    "@app/views/home/post.php",
                                    ["post" => $post]
                                );
                            };
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- .viewport -->
</div> <!-- .f -->

