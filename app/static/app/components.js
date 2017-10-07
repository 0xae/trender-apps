Vue.directive('tx-img-cache', {
  bind: function (el, b, vnode) {
    var post = b.value.post;
    var cached = post.cached;
    var url = 'http://127.0.0.1:5000/api/post/media/'+post.id+'/download';
    
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
    } else if (!cached || cached=="none" || cached.startsWith('/opt/lampp/htdocs')){
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
        updateImage('../' + href);
    }
  }
})
