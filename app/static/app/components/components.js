angular.module('trender')
.run(['app', function (app) {
    var api = app.server.api;
    
    // tx-img-cache
    // @params post
    // @description fetches/caches the post image
    //                or just sets the image it's already cached
    Vue.directive('tx-img-cache', {
      bind: function (el, b, vnode) {
        var post = b.value.post;
        var cached = post.cached;
        var url = api + 'post/media/'+post.id+'/download';

        function updateImage(src) {
            if (b.value.done)
                b.value.done(vnode, src);
            vnode.elm.src = src;
        }    

        if (b.value.link && post.picture != b.value.link) {
            var link = encodeURIComponent(b.value.link);
            url = url + "?link=" + link; 
            cached = false;
        }

        if (post.picture.startsWith('data:')) {
            var coma = post.picture.indexOf(';');
            var img = post.picture.substr(0, coma) +
                        ';charset=utf-8' +
                        post.picture.substr(coma);
            updateImage(img);
        } else if (!cached || 
                    cached=="none" || 
                    // XXX: remove this
                    cached.indexOf('/opt/lampp/htdocs') != -1) {
            // cache the image
            fetch(url)
            .then(function (resp) {
                resp.text()
                .then(function (img) {
                    updateImage('../'+img);
                    post.picture = b.value.link;
                });
            });
        } else {
            var href;
            try {
                var ary = JSON.parse(cached);
                href = 'downloads/' + ary[0];
            } catch (e) {
                href = cached;
            }

            // XXX: remove this
            href = href.replace('/opt/lampp/htdocs', '');
            updateImage('../' + href);
        }
      }
    });
    
    function updatePostStream(data, id) {
        if (!data.stream.count)
            return;
            
        var posts_loader = "#"+id+" .posts_loader";
        var posts_count = "#"+id+" .post_count";
        var stream_start = "#"+id+" .stream_start";
        var containerId = 'cont_'+data.stream.posts[0]['id'];

        $(posts_loader).show();
        $(post_count).text(data.stream.count);
        var html ='<div class="post-container" '+
                        'id="'+containerId+'" '+
                        'style="display:none">'+
            data.html+
        '</div>';

        setTimeout(function (){
            $(stream_start).prepend(html);
            $("#"+containerId).slideDown(759.123);
            data.stream.posts.forEach(function (p) {
                new Vue({el: "#img-"+p.id, data:{post: p}});
            });
            setTimeout(function(){
                $(posts_loader).hide();
            }, 500);                   
        }, 1500);
    }

    Vue.directive('tx-post-stream', {
        bind: function (el, b, vnode) {
            var data = b.value;
            var id = vnode.elm.id;
            updatePostStream(data, id);
            this.id = id;
        },

        methods: {
            update: function (stream) {
                console.info('stream ', stream);
                updatePostStream(stream, this.id);
            }
        }
    });
}]);

