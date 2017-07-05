angular.module('trender')
.factory('PostService', ['$http', '$q', '$api', function ($http, $q, API){
    function promisify(p) {
        return p.then(function (resp) {
            return resp.data;
        });
    }

    return {
        getPostById: function (id) {
            return $.get(API.url() + 'post/'+id);
        },

        getPostByFbId: function (fbid) {
            return promisify($http.get(API.url() + 'post/fbid/'+fbid));
        },

        getRecentPosts: function (time) {
            var url = API.url() + 'api/recent_posts';
            if (time) {
                var timef = decodeURIComponent(time); 
                url = url + "?time="+ timef;
            }
            return promisify($http.get(url));
        }
    }
}]);
