angular.module('trender')
.factory('$api', [function (){
    return {
        url: function () {
            var idx = location.href.indexOf('trender');
            var host = location.href.substr(0, idx-1);
            var API = host + ':5000/';
            return API;
        }
    }
}]);
