(function (){
    var totalInPage = 0;
    var MAX_POSTS_PER_PAGE=5;

    function stream(limit) {
        // extract the timeline id from the url
        var id = /id=(\d+)/.exec(location.href)[1];
        if (!id) {
            return;
        }
        var limit = limit || _.random(3, 5);

        console.info('[INFO] stream ('+limit+') posts from timeline ', id);
        fetch('./index.php?r=timeline/stream&id='+id+"&limit="+limit)
        .then(function (data) {
            data.json()
            .then(function (data) {
                if (!data.stream.count) return;
                $("#posts_loader").slideDown(821);
                var containerId = 'cont_'+data.stream.posts[0]['id'];
                totalInPage += data.stream.count;
                $("#post_count").text(data.stream.count);
                var html ='<div class="post-container" id="'+containerId+'" style="display:none">'+data.html+'</div>';

                setTimeout(function (){
                    if (totalInPage > MAX_POSTS_PER_PAGE) {

                    }

                    $("#stream_start").prepend(html);
                    $("#"+containerId).slideDown(759.123);
                    setTimeout(function(){
                        $("#posts_loader").hide();
                    }, 500);                   
                }, 1500);
            });
        });
    }
    
    setInterval(stream, 20*1000);
})();
