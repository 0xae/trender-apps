angular.module('trender')
.run(['app', 'Timeline', function (app, Timeline) {
    Vue.directive('tx-post-stream', {
        bind: function (el, b, vnode) {
            /*
            var data = b.value;
            var id = '#'+vnode.elm.id;
            
            if (b.value.onUpdate) {                
            } else {
            }
            */
        }
    });
}]);

