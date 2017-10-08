<?php
$this->title = 'Trender Home';
?>

<!-- Feed Area -->
<div class="f">

    <div id="app-left-col" class="">
            <?php
                echo \Yii::$app->view->renderFile(
                    "@app/views/timeline/appbar.php",
                    ["timeline" => $timeline, 
                    "timeline_list"=>$timeline_list
                    ]
                );
            ?>
    </div>

    <div id="viewport">
        <div id="objects_container" ng-controller="TimelineController">
            <div class="bq e" id="root" role="main">
                <div id="m_home_notice"></div>
                <div id="m_newsfeed_stream" style="background-color: #fff;">
                    <div id="posts_container" 
                         v-tx-post-stream:stream="obj" 
                         class="dp dq dr" 
                         style="padding:0px;">
                        <div class="ds di" class="posts_loader" style="">
                            <div >
                                <a href="javascript:void(0)" id="load_more_posts">
                                    <p style="text-align: center"> 
                                     <span class="post_count">0</span> new posts comming... </p>
                                </a>
                            </div>
                        </div>

                        <div class="stream_start"></div>

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
    
    <div id="app-video-stream" class="dp dq dr">
        <?php if (!empty($videos)):
                echo \Yii::$app->view->renderFile(
                    "@app/views/timeline/youtube_featured_post.php",
                    ["post" => $videos[0]]
                );
                unset($videos[0]);
        ?>
        <div class="tr-up-next">
        <?php
                foreach ($videos as $post) {
                    echo \Yii::$app->view->renderFile(
                        "@app/views/timeline/youtube_post.php",
                        ["post" => $post]
                    );
                }
                
                endif;
        ?>
        </div>
    </div>
</div> <!-- .f -->

