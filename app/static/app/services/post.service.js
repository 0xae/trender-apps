angular.module('trender')
.factory('PostService', ['$http', '$q', '$api', function ($http, $q, API){
    function promisify(p) {
        return p.then(function (resp) {
            return resp.data;
        });
    }

    function fetchPosts(time, limit, offset, sortOrder) {
        var url = API.url() + 'api/recent_posts?';
        if (time) {
            var timef = decodeURIComponent(time); 
            url = url + "time="+ timef  + '&';
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
        limit = limit || 4;
        return fetchPosts(startDate, limit, offset, 'asc')
        .then(function (data) {
            if (data.length > 0) {
                offset += 4;        
            }
            return data;
        });
    }

    return {
        getPostById: function (id) {
            return $.get(API.url() + 'post/'+id);
        },

        getPostByFbId: function (fbid) {
            return promisify($http.get(API.url() + 'post/fbid/'+fbid));
        },

        getRecentPosts: fetchPosts,
        stream: stream,
    }
}]);
