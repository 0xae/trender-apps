angular.module('trender')
.factory('Timeline',['app', function (app){
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
    
    return {
        getById: getById,
        getAll: getAll,
        getByName: getByName,
        stream: stream
    };
}]);
