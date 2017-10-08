_.templateSettings = {
  interpolate: /\{\{(.+?)\}\}/g
};

angular.module('trender', [])
.factory('app', function () {
    function promisify(prms) {
        return new Promise(function (resolve, reject){
            prms.then(resolve, reject);
        });
    }

    var server = {
        api: 'http://127.0.0.1:5000/api/'
    };

    return {
        server: server
    };
});

