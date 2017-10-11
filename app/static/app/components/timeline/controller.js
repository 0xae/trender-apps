requirejs(['trender/app', 'trender/timeline', '_', 'vue'], 
function (app, Timeline, _, Vue){
    // every N seconds
    var MAX_POSTS_PER_PAGE=5;
    var STREAM_INTERVAL = 6*1000;
    var main = null, vids = null;

    function stream() {
        var id = /id=(\d+)/.exec(location.href)[1];
        var limit = _.random(3, 5);

        Timeline.stream({id:id, limit:limit})
        .then(function (data){
            if (!main) {
                main = Timeline.component("#posts_container", {stream:{posts:[]}});
                vids = Timeline.component("#vidStream", {stream: {posts:[]}});
            }
            
            main.update({
                html: data.html,
                posts: data.stream.posts
            });

            vids.update({
                html: data.html_video,
                posts: data.stream.posts.filter(function (x){
                    return x.type == 'youtube-post';
                })
            });
        });
    }

    stream();
    setInterval(stream, STREAM_INTERVAL);
});

