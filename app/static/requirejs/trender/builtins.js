define("trender/builtins", ['trender/app','trender/timeline', 'vue'], 
function (app, Timeline, Vue) {
    var api = app.server.api;
    // tx-img-cache
    // @params post
    // @description fetches/caches the post image
    //                or just sets the image if it's already cached
    Vue.directive('tx-img-cache', {
      bind: function (el, b, vnode) {
        var post = b.value.post;
        if (!post) return;
        var cached = post.cached;
        var url = api + 'post/media/'+post.id+'/download';

        function updateImage(src) {
            vnode.elm.src = src;
            if (b.value.done) {            
                b.value.done(vnode, src);
            }
        }    

        if (b.value.link && post.picture != b.value.link) {
            var link = encodeURIComponent(b.value.link);
            url = url + "?link=" + link;
            cached = false;
        }

        if (post.picture && post.picture.startsWith('data:')) {
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
});

