angular.module('trender')
.factory('PostService', ['$http', '$q', '$api', function ($http, $q, API){
    function promisify(p) {
        return p.then(function (resp) {
            return resp.data;
        });
    }

    var seedPost=undefined;
    function getSeed(startDate) {
        var q = $q.defer();
        if (seedPost == undefined) {
            var seedUrl = API.url() + 'api/recent_posts?time='+decodeURIComponent(startDate)
                     + '&limit=1&o=asc';

            promisify($http.get(seedUrl))
                .then(function (data) {
                    if (data.length==0) {
                        q.resolve(null); // no posts fella
                    } else {
                        var older = data[0];
                        var t = moment(older.timestampFmt);
                        q.resolve(t);
                    }
                });
        } else {
            q.resolve(seedPost);
        }

        return q.promise;
    }

    function stream(startDate) {
        var q = $q.defer();
        return q.promise;
    }

    return {
        getPostById: function (id) {
            return $.get(API.url() + 'post/'+id);
        },

        getPostByFbId: function (fbid) {
            return promisify($http.get(API.url() + 'post/fbid/'+fbid));
        },

        getRecentPosts: function (time,limit,sortOrder) {
            var url = API.url() + 'api/recent_posts?';
            if (time) {
                var timef = decodeURIComponent(time); 
                url = url + "time="+ timef  + '&';
            }
            if (limit) {
                url = url + 'limit='+limit+'&';
            }
            if (sortOrder) {
                url = url + 'o='+ sortOrder + '&';
            }

            return promisify($http.get(url));
        }
    }
}]);
