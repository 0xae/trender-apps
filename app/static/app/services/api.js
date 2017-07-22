angular.module('trender')
.factory('$api', [function (){
    return {
        url: function () {
            var idx = location.href.indexOf('trender');
            var host = location.href.substr(0, idx-1);
            var API = host + ':5000/';
            return API;
        },

        formatPostTime: function (time) {
            var m=moment(time);
            var today = moment();

            if (today.format("YYYY-MM-DD") == m.format("YYYY-MM-DD")) {
                return m.format("h:mm:ssa");
            } else {
                return m.format("MMM DD YYYY, h:mm:ssa");
            }
        }
    }
}]);
