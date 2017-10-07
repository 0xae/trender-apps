define(['require', '$'], function (require, $){
    var MAX_POSTS_PER_PAGE=5;
    var STREAM_INTERVAL = 5*1000; // every 10 seconds

    return function (timelineConf){
        var id = timelineConf.id;
        var limit = timelineConf.limit || _.random(3, 5);

        function stream(showLoader) {
            // extract the timeline id from the url
            // var id = /id=(\d+)/.exec(location.href)[1];
            // var limit = _.random(3, 5);
            // if (!id) {
            //     return;
            // }

            fetch('./index.php?r=timeline/stream&id='+id+"&limit="+limit)
            .then(function (data) {
                data.json()
                .then(function (data) {
                    if (!data.stream.count) return;
                    $("#posts_loader").show();
                    var containerId = 'cont_'+data.stream.posts[0]['id'];
                    $("#post_count").text(data.stream.count);
                    var html ='<div class="post-container" id="'+containerId+'" style="display:none">'+data.html+'</div>';

                    setTimeout(function (){
                        $("#stream_start").prepend(html);
                        $("#"+containerId).slideDown(759.123);
                        data.stream.posts.forEach(function (p) {
                            new Vue({el: "#img-"+p.id, data:{post: p}});
                        });
                        setTimeout(function(){
                            $("#posts_loader").hide();
                        }, 500);                   
                    }, 1500);
                });
            });
        }

        setInterval(stream, STREAM_INTERVAL);
    }
});
