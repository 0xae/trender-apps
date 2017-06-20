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


new Vue({
    el: '#app',
    data: {
        message: "hey there"
    }
});

new Vue({
    el: '#app-2', 
    data:{
        message: "hey there " + new Date()
    }
});


new Vue({
    el: '#app-3', 
    data: {
        seen: true
    }
});

var app4 = new Vue({
    el: '#app-4', 
    data: {
        todos: [
            {text: "Todo 1"}
        ]
    }
});

var app5 = new Vue({
    el: '#app-5',
    data: {
        message: "Vue component"
    },
    methods: {
        updateData: function () {
            this.message = 'Vue component at ' + new Date();
        }
    }
});

new Vue({
    el: '#app-6', 
    data:{
        message: "hey there " + new Date()
    }
});

// data
Vue.component('todo-item', {
    template: '<li>This is a todo</li>'
});


