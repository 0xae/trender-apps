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

        return promisify($http.get(url));
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
