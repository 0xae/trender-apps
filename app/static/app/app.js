/*
angular.module('trender', [])
.factory('app', function () {
    function promisify(prms) {
        return new Promise(function (resolve, reject){
            prms.then(resolve, reject);
        });
    }

});
*/

define("trender/app", [], function () {
    var server = {
        api: 'http://127.0.0.1:5000/api/'
    };
    
    console.info("hello ");

    return {
        server: server
    }
});

requirejs(['jquery', '_', 'trender/app'], function ($, _, app) {
    _.templateSettings = {
        interpolate: /\{\{(.+?)\}\}/g
    };
    
    console.info("app server is at", app);
});

