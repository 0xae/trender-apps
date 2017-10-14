<?php
use app\models\Post;
$this->title = "Trending in {$timeline->name}";
// $videos = [];
// $posts = [];
?>

<!-- Feed Area -->
<div class="f">
    <div id="app-left-col" class="">
        <?php
            echo \Yii::$app->view->renderFile(
                "@app/views/timeline/appbar.php", 
                [
                    "timeline" => $timeline, 
                    "timeline_list"=>$timeline_list
                ]
            );
        ?>
    </div>

    <div id="viewport">
        <div id="objects_container">
            <div class="bq e" id="root" role="main">
                <div id="m_home_notice"></div>
                <div id="m_newsfeed_stream" style="background-color: #fff;">
                    <div id="posts_container" 
                         v-tx-post-stream:stream.showLoader="stream"
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
        <!-- #objects_container -->

        <div id="app-video-stream" class="dp dq dr">
            <?php
                $post = new Post;
                if (!empty($videos)) {
                    $post = $videos[0];
                    unset($videos[0]);
                }

                echo \Yii::$app->view->renderFile (
                    "@app/views/plugins/youtube_featured/index.php",
                    ["post" => $post]
                );
            ?>

            <div class="tr-up-next-label" style="">
                <h1 style="">
                    up next
                </h1>
            </div>
            
            <div class="tr-up-next"
                 id="vidStream"
                 v-tx-post-stream:stream="stream">     

                <div id="vidStream_stream_start"></div>
                <?php
                    echo \Yii::$app->view->renderFile (
                        "@app/views/plugins/youtube_stream/index.php",
                        ["posts" => $videos]
                    );
                ?>
            </div>
        </div>
        <!-- #app-video-stream -->

    </div> <!-- #viewport -->
</div> <!-- .f -->

