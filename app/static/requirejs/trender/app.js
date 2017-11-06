define("trender/app", function () {
    var service={
        apiHost: function() {
            // var idx = location.href.substr(7).indexOf("/");
            // var server = {
            //     api: location.href.substr(0, idx+7) + ':5000' + '/api/'
            // };
            // 192.168.1.85
            var api = localStorage.getItem("trender_api");
            return api || "http://127.0.0.1:5000/";
        },

        api: function() {
            var host = service.apiHost();
            return host + 'api/';
        },

        mediaHost: function() {
            var host = localStorage.getItem("trender_host") || 'http://127.0.0.1';
            return host + "/trender/";
        }
    };

    return service;
});

