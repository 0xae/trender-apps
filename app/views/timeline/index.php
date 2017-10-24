<?php
use app\models\Post;
$this->title = "Trending in {$timeline->name}";
?>

<!-- Feed Area -->
<div class="f">
    <div id="app-left-col" class="">
        <?php
            echo \Yii::$app->view->renderFile(
                "@app/views/timeline/appbar.php", [
                    "timeline" => $timeline,
                    "timeline_list" => $timeline_list
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
                echo \Yii::$app->view->renderFile(
                    "@app/views/plugins/youtube_featured/index.php",
                    ["post" => new Post]
                );
            ?>

            <div class="tr-up-next-label" style="">
                <h1 style="">up next</h1>
            </div>

            <div id="vidStream" class="tr-up-next">
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

<script>
requirejs(['trender/app', 'trender/timeline', 
        'trender/builtins', '_',  'vue', 'jquery'],
function (app, Timeline, builtins, _, Vue, $){
    // every N seconds
    var MAX_POSTS_PER_PAGE=5;
    var STREAM_INTERVAL = 8*1000;
    var main = null, vids = null;

    function stream() {
        var id = /id=(\d+)/.exec(location.href)[1];
        var limit = _.random(3, 5);

        Timeline.stream({id:id, limit:limit})
        .then(function (data){
            if (!main) {
                main = Timeline.component("#posts_container", 
                                         {stream:{posts:[], showLoader: true}});
                vids = Timeline.component("#vidStream",
                                        {stream:{posts:[], showLoader: false}});
            }

            main.update({
                html: data.html,
                timeline: data.timeline,
                posts: data.stream.posts
            });

            vids.update({
                html: data.html_video,
                timeline: data.timeline,
                posts: data.stream.posts.filter(function (x){
                    return x.type == 'youtube-post';
                })
            });
        });
    }

    var timelineData = {
        name: "",
        listing: [],
        showForm: false,
        submit: function (data) {
            var topic = data.topic;
            var name = data.name || data.topic;
            if (topic.trim() == "") {
                return;
            }

            var topicf = '"'+
                        topic.trim().replace(/"/g, '') +
                        '"';

            var obj = {
                name: name,
                topic: topicf,
                description: "timeline " + name,
                postTypes: "steemit-post,twitter-post,youtube-post"
            };

            Timeline.create(obj)
            .then(function (data) {
                timelineData.listing.push(data);
                timelineData.showForm = false;
            });
        },

        showTForm: function () {
            timelineData.showForm = true;
        },

        hideTForm: function () {
            timelineData.name = "";
            timelineData.showForm = false;
        },
    };

    new Vue({
        el: "#app-left-col",
        data: timelineData,
        methods: {
            deleteTimeline: function (id, index) {
                if (!confirm("Are you sure?"))
                    return;

                Timeline.delete(id)
                .then(function (){
                    $("#tl-"+id).remove();
                });
            }
        }
    });

   stream();
   setInterval(stream, STREAM_INTERVAL);
});
</script>

