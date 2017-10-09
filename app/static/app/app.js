define("trender/app", function () {
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
    }
});

requirejs(['jquery', '_', 'trender/app'], function ($, _, app) {
    _.templateSettings = {
        interpolate: /\{\{(.+?)\}\}/g
    };

    console.info("app server is at", app);
});

