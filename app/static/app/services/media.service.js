angular.module('trender')
.factory('MediaService', ['$http', '$q', '$api', function ($http, $q, API){
    function promisify(p) {
        return p.then(function (resp) {
            return resp.data;
        });
    }

    function fetchRecentMedia() {
        var url = API.url() + 'api/media/recent?';        
    }

    function fetchMediaFrom() {        
        var url = API.url() + 'api/media?';        
    }

    return {
        fetchRecentMedia: fetchRecentMedia,
        fetchMediaFrom: fetchMediaFrom
    };
}]);
