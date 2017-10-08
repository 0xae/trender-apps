angular.module('trender')
.controller('TimelineController', ['Timeline', function (Timeline){
    var STREAM_INTERVAL = 5*1000;
    // every N seconds
    var MAX_POSTS_PER_PAGE=5;
    var main = null;

    function stream() {
        var id = /id=(\d+)/.exec(location.href)[1];
        var limit = _.random(3, 5);

        Timeline.stream({id:id, limit:limit})
        .then(function (data){
            console.info(data);
            if (!main) {            
                main=new Vue({
                    el: "#posts_container", 
                    data:{obj: data},
                    methods: {
                        update: function (stream) {
                            console.info('stream ', stream);
                        }
                    }
                });
            }            
            main.update(data);
        });
    }

    stream();
}]);
