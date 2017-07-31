angular.module('trender')
.factory('PostService', ['$http', '$q', '$api', function ($http, $q, API){
    function promisify(p) {
        return p.then(function (resp) {
            return resp.data;
        });
    }

    function fetchPosts(time, limit, offset, sortOrder) {
        var url = API.url() + 'api/post/recent?';
        if (time) {
            var timef = encodeURIComponent(time); 
            url = url + "since="+ timef  + '&';
        }
        if (offset) {
            url = url + 'offset='+offset+'&';
        }
        if (limit) {
            url = url + 'limit='+limit+'&';
        }
        if (sortOrder) {
            url = url + 'o='+ sortOrder + '&';
        }

        return promisify($http.get(url));
    }

    var offset=0;
    function stream(startDate, limit) {
        return fetchPosts(startDate, limit, offset, 'asc')
        .then(function (data) {
            if (data.length > 0) {
                offset += 4;      
            }
            return data;
        });
    }

    // TODO: use $q
    var cache = [];
    function cachePosts(posts) {
        var p = new Promise(function(resolve, reject){
            cache = cache.concat(posts);
            resolve(cache.slice());
        });
        return p;
    }

    function searchPosts(query) {
        return $.get(API.url() + 'api/post/search?q=' + encodeURIComponent(query));
    }

    function getCache() {
        var defer = $q.defer();
        defer.resolve(cache.slice());
        return defer.promise;
    }

    return {
        getRecent: fetchPosts,
        stream: stream,
        cache: cachePosts,
        getCache: getCache,
        search: searchPosts
    }
}]);
