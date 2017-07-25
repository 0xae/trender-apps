angular.module('trender')
.factory('MediaService', ['$http', '$q', '$api', 'PostService', function ($http, $q, $api, pService){
    function promisify(p) {
        return p.then(function (resp) {
            return resp.data;
        });
    }

    function fetchRecent(since, fid, type, offset) {
        fid = fid || 'everybody';
        type = type || '*';
        var url = $api.url() + 'api/media/recent?';
        url += 'fid='+encodeURIComponent(fid)+'&';
        url += 'type='+encodeURIComponent(type)+'&';
 
        if (offset) {
            url += 'offset='+encodeURIComponent(offset)+'&';
        }

        if (since) {
            url += 'since='+encodeURIComponent(since)+'&';
        }

        var defer = $q.defer();

        $http.get(url)
        .then(function (resp) {
           resp.data.forEach(function (p) {
                var json = p.jdata = JSON.parse(p.data);
                json.app_url = json.url;
                json.time_fmt = $api.formatPostTime(p.timeFmt);
                var cache = json._cache;
                if (!_.isEmpty(cache)) {
                    json.app_url = $api.serverHost() + "/trender/media/" + cache[0];
                }
                
                console.info("app_url: ", json.app_url);              
                defer.resolve(resp.data);
            });
        });

         return defer.promise;
    }

    function indexMedia(urls) {
        return $http.post($api.url() + 'api/media/index', JSON.stringify(urls));
    }

    function fetchMediaFrom() {        
        var url = $api.url() + 'api/media?';        
    }

    return {
        recent: fetchRecent,
        fetchFrom: fetchMediaFrom,
        index: indexMedia,
    };
}]);
