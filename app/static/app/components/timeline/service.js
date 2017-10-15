define("trender/timeline", ['trender/app', 'vue', 'jquery', 'trender/builtins'], 
function (app, Vue, $){
    const api = app.server.api;

    function stream(conf) {
        var limit = conf.limit || _.random(3, 5);
        var id = conf.id;
        var q = new Promise(function (resolve, reject){
            fetch('./index.php?r=timeline/stream&id='+id+"&limit="+limit)
            .then(function (data) {
                data.json()
                .then(function (data) {
                    resolve(data);
                }, function (err) {
                    reject(err);
                });
            });
        });
        return q;
    }

    function default_fetch(url) {
        return new Promise(function (resolve, reject){
            fetch(url)
            .then(function (data) {
                data.json()
                .then(resolve, reject);
            });
        });
    }

    function getById(id) {
        return default_fetch(api + 'timeline/'+id);
    }

    function getByName(name) {
        var namef = encodeURIComponent(name);
        var url = api + 'timeline/'+namef+'/stream_name';
        return default_fetch(url);
    }

    function getAll() {
        var url = api + 'timeline/';
        return default_fetch(url);
    }

    function create(data) {
        var url = api + "timeline/new";
        return $.ajax({
            url: url,
            method: 'POST',
            data: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        });
    }

    function deleteTimeline(id) {
        var url = api + "timeline/"+id;
        return $.ajax({
            url: url,
            method: 'DELETE'
        });
    }

    function updateStream(stream, showLoader, id) {
        var posts = stream.posts;
        var _html = stream.html;

        if (!posts.length) {
            return;
        }

        var stream_start = id+"_stream_start";
        var posts_loader = id+"_posts_loader";
        var posts_count = id+"_posts_count";
        var posts_loader_div = id+"posts_container_loader_div";
        var containerId = 'cont_'+posts[0].id;

        var tpl = '';
        if (showLoader === true) {
            $(posts_loader).css("background-color", "#2b55ad !important");
            $(posts_loader).show();
            $(posts_count).text(posts.length);
            tpl="display: none;";
        }

        var html = '<div class="post-container" '+
                        'id="'+containerId+'" '+
                        'style="'+ tpl +'">' +
                            _html + 
                   '</div>';

        $(stream_start).prepend(html);
        $("#"+containerId).slideDown(783.123);

        setTimeout(function (){
            var last = false;
            posts.forEach(function (p) {
                var id = "#tr-post-" + p.id;
                if (p.type == 'youtube-post') {
                    // XXX: remove this later
                    var json = JSON.parse(p.data);                        
                    var picture = "https://img.youtube.com/vi/"+
                                  json['video_id'] +  "/0.jpg";

                    miniYoutube(id, p, picture);
                } else {
                    postComponent(id, p);
                }
            });

            if (showLoader === true) {
                setTimeout(function(){
                posts_container_loader_div
                    $(posts_loader).css("background-color", "#fff !important");
                    $(posts_count).text('0');                
                }, 500);
            }
        }, 1500);
    }

    var node = null, data = null;
    function featureYoutubePost(post, picture) { 
        post.json = JSON.parse(post.data);
        if (!node) {
            data = {
                post: post,
                link: picture,
                done: function (node, src) {
                    var tpl = 'url('+src+') no-repeat 10px -57px'
                    node.elm.style['background'] = tpl;
                }
            };

            node = new Vue({
                el: "#tr-youtube-featured",
                data: data,
                methods: {
                    playVideo: function (post) {
                        console.info("playing: " + post.description);
                    }
                }
            });
        } else {
            data.post = post;
            data.link = picture;        
        }
    }

    function component(elementId, data) {
        return new Vue({
            el: elementId, 
            data: data,
            methods: {
                update: function (stream) {
                    updateStream(
                        stream,
                        data.stream.showLoader, 
                        elementId
                    );
                },
            }
        });
    }

    function miniYoutube(el, p, picture) {
        return new Vue({
            el: el,
            data: {
                post: p,
                link: picture,
                done: function (node, src) {
                    var tpl = 'url('+src+') no-repeat 0px';
                    node.elm.style['background'] = tpl;
                },
            },
            methods: {
                select: function (post) {
                    console.info("set featureYoutubePost: ", post);
                    featureYoutubePost(post, post.picture);
                }
            }
        });
    }

    function postComponent(el, post) {
        return new Vue({
            el: el,
            data:{
                post: post
            },
            methods: {
                like: function (post) {
                    console.info("post liked: ", post);
                }
            }
        });
    }

    return {
        getById: getById,
        getAll: getAll,
        getByName: getByName,
        stream: stream,
        component: component,
        featureYoutubePost: featureYoutubePost,
        miniYoutube: miniYoutube,
        create: create,
        delete: deleteTimeline,
        post: postComponent
    };
});
