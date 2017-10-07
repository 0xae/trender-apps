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

$(document).ready(function (){
    $("#posts_loader").hide();
});


