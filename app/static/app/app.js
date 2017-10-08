_.templateSettings = {
  interpolate: /\{\{(.+?)\}\}/g
};

angular.module('trender', [])
.factory('app', function () {
    function promisify(prms) {
        return new Promise(function (resolve, reject){
            prms.then(resolve, reject);
        });
    }

    var server = {
        api: 'http://127.0.0.1:5000/api/'
    };

    function updatePostStream(data, showLoader, id) {
        if (!data.stream.count)
            return;

        if (showLoader === true) {
            var posts_loader = id+" .posts_loader";
            var posts_count = id+" .posts_count";
            var stream_start = id+" .stream_start";
            var containerId = 'cont_'+data.stream.posts[0]['id'];

            $(posts_loader).show();
            $(posts_count).text(data.stream.count);
        }

        var html ='<div class="post-container" '+
                        'id="'+containerId+'" '+
                        'style="display:none">'+
            data.html+
        '</div>';

        setTimeout(function (){
            $(stream_start).prepend(html);
            $("#"+containerId).slideDown(783.123);
            data.stream.posts.forEach(function (p) {
                new Vue({el: "#img-"+p.id, data:{post: p}});
            });

            if (showLoader === true) {
                setTimeout(function(){
                    console.warn(posts_loader);
                    $(posts_loader).hide();
                    $(posts_count).text('0');                
                }, 500);
            }
        }, 1500);
    }

    return {
        server: server,
        updatePostStream: updatePostStream
    };
});

