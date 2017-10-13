requirejs(['trender/app', 'trender/timeline', '_', 'vue', 'jquery'], 
function (app, Timeline, _, Vue, $){
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
                if (!confirm("Delete this timeline?")) {
                    return;
                }
                
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

