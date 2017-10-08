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
            data.stream.posts.forEach(function (p) {
                console.info("Type: ", p.type);
                if (p.type == 'youtube-post') {
                    console.info("youtube:  ", p);
                } else {
                    new Vue({el: "#img-"+p.id, data:{post: p}});
                }
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

