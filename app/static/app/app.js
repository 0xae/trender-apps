function promisify(prms) {
    return new Promise(function (resolve, reject){
        prms.then(resolve, reject);
    });
}

// log success for promises
function _logS(i) { console.info(i); }

// log error for promises
function _logE(i) { console.error(i); }

_.templateSettings = {
  interpolate: /\{\{(.+?)\}\}/g
};

function getApiHost() {
    var idx = location.href.indexOf('trender');
    var host = location.href.substr(0, idx-1);
    var API = host + ':5000/';
    return API;
}

var app = new Vue({
    el: '#app',
    data: {
        message: "hey there"
    }
})


