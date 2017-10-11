define("trender/app", function () {
    function promisify(prms) {
        return new Promise(function (resolve, reject){
            prms.then(resolve, reject);
        });
    }
    
    var idx = location.href.substr(7).indexOf("/");

    var server = {
        api: location.href.substr(0, idx+7) + ':5000' + '/api/'
    };

    return {
        server: server
    }
});

requirejs(['jquery', '_', 'trender/app'], function ($, _, app) {
    _.templateSettings = {
        interpolate: /\{\{(.+?)\}\}/g
    };

    console.info("app config: ", app);
});

