define("trender/app", function () {
    var idx = location.href.substr(7).indexOf("/");
    var server = {
        api: location.href.substr(0, idx+7) + ':5000' + '/api/'
    };

    return {
        server: server
    }
});

