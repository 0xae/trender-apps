angular.module('trender')
.factory('PostService', ['$http', '$q', '$api', function ($http, $q, API){
    function _resolveData(p) {
        return p.then(function (resp) {
            return resp.data;
        });
    }

    function getData(q) {
        var url = 'http://localhost:8983/solr/trender/query?q='+q+
                  '&facet=true'+
                  '&facet.field=category'+
                  '&facet.field=type';
        return _resolveData($http.get(url));
    }

    return {
        getData: getData
    }
}]);
