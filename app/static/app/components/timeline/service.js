define("trender/timeline", ['trender/app', 'vue'], function (app, Vue){
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

    function updateStream(_html, posts, showLoader, id) {
        if (!posts.length)
            return;

        var stream_start = id+"_stream_start";
        var posts_loader = id+"_posts_loader";
        var posts_count = id+"_posts_count";
        var containerId = 'cont_'+posts[0].id;

        if (showLoader === true) {
            $(posts_loader).show();
            $(posts_count).text(posts.length);
        }

        var html ='<div class="post-container" '+
                        'id="'+containerId+'" '+
                        'style="display: none">'+
            _html+
        '</div>';

        var ary = [
            '22d66e8c741c3573d9bcdb3176d5ec3b.jpg',
            'c72b679283d5fdf4e198fe18b5461437.jpg',
            'e33bfe546673f7f4151003b17b162b48.jpg',
            '30fe705c1b9e5e43ebe5c56e5b02b1e4.jpg',
            '2b8d78185b85ae21610b14dc25f88ce8.jpg',
            '8df4fbeaf573ddd4458d3977a03dcbce.jpg'
        ];
        var idx = _.random(0, ary.length-1);

        setTimeout(function (){
            $(stream_start).prepend(html);
            $("#"+containerId).slideDown(783.123);

            posts.forEach(function (p) {
                if (p.type == 'youtube-post') {
                } else {
                    new Vue({el: "#img-"+p.id, data:{post: p}});
                }
            });

            if (showLoader === true) {
                setTimeout(function(){
                    $(posts_loader).hide();
                    $(posts_count).text('0');                
                }, 500);
            }
        }, 1500);
    }

    function component(elementId, data) {
        return new Vue({
            el: elementId, 
            data: data,
            methods: {
                update: function (stream) {
                    updateStream(stream.html, stream.posts, true, elementId);
                }
            }
        });
    }

    return {
        getById: getById,
        getAll: getAll,
        getByName: getByName,
        stream: stream,
        component: component
    };
});
