define("trender/timeline", ['trender/app', 'vue', 'jquery'], 
function (app, Vue, $){
    const MAX_POSTS_PER_PAGE=5;
    const STREAM_INTERVAL = 5*1000; // every 10 seconds
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
            headers: {
                'Content-Type': 'application/json'
            },
            data: JSON.stringify(data)
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
                if (p.type == 'youtube-post') {
                    var id = "#yt-img-" + p.id;
                    var json = JSON.parse(p.data);                        
                    var picture = "https://img.youtube.com/vi/"+
                                  json['video_id'] + 
                                        "/0.jpg";                                      
                    miniYoutube(id, p, picture);
                    if (!last) {
                        p.picture = picture;
                        last = p;
                    }
                } else {
                    new Vue({el: "#img-"+p.id, data:{post: p}});
                }
            });

            if (last) {
                featureYoutubePost(last, last.picture);
            }

            if (showLoader === true) {
                setTimeout(function(){
                posts_container_loader_div
                    $(posts_loader).css("background-color", "#fff !important");
                    $(posts_count).text('0');                
                }, 500);
            }
        }, 1500);
    }

    function featureYoutubePost(youtubePost, picture) {
        return new Vue({
            el: "#tr-outdoor-img",
            data:{
                post: youtubePost,
                link: picture,
                done: function (node, src) {
                    var tpl = 'url('+src+') 10px -57px'
                    node.elm.style['background'] = tpl;
                }
            }
        });
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
                }
            }
        });
    }

    function miniYoutube(el, p, picture) {        
        return new Vue({
            el: el,
            data:{
                post: p,
                link: picture,
                done: function (node, src) {
                    var tpl = 'url('+src+') no-repeat 0px';
                    node.elm.style['background'] = tpl;
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
        delete: deleteTimeline
    };
});
