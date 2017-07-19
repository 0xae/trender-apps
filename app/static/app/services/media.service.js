angular.module('trender')
.factory('MediaService', ['$http', '$q', '$api', function ($http, $q, API){
    function promisify(p) {
        return p.then(function (resp) {
            return resp.data;
        });
    }

    function fetchRecent(since, fid, type) {
        fid = fid || 'everybody';
        type = type || '*';
        var url = API.url() + 'api/media/recent?';
        url += 'fid='+encodeURIComponent(fid)+'&';
        url += 'type='+encodeURIComponent(type)+'&';

        if (since) {
            url += 'since='+encodeURIComponent(since)+'&';
        }

        return $http.get(url)
               .then(function (resp) {
                   resp.data.forEach(function (p) { 
                        var json = p.jdata = JSON.parse(p.data);
                        json.app_url = json.url;
                        var cache = json._cache;
                        if (!_.isEmpty(cache)) {
                            json.app_url = "http://127.0.0.1/trender/media/" + cache[0];
                        }
                   });
                   return resp.data;
               });
    }

    function indexMedia(urls) {
        return $http.post(API.url() + 'api/media/index', JSON.stringify(urls));
    }

    function fetchMediaFrom() {        
        var url = API.url() + 'api/media?';        
    }

    return {
        recent: fetchRecent,
        fetchFrom: fetchMediaFrom,
        index: indexMedia
    };
}]);
