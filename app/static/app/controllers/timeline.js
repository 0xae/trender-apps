angular.module('trender')
.controller('TimelineController', ['Timeline', 'app', 
function (Timeline, app){
    var STREAM_INTERVAL = 8*1000;
    // every N seconds
    var MAX_POSTS_PER_PAGE=5;
    var main = null;

    function stream() {
        var id = /id=(\d+)/.exec(location.href)[1];
        var limit = _.random(3, 5);

        Timeline.stream({id:id, limit:limit})
        .then(function (data){
            if (!main) {
                var id = "#posts_container";            
                main = new Vue({
                    el: id, 
                    data:{stream: data},
                    methods: {
                        update: function (stream) {
                            app.updatePostStream(stream, true, id);
                        }
                    }
                });
            } else {
                main.update(data);
            }
        });
    }

    stream();
    setInterval(stream, STREAM_INTERVAL);
}]);
