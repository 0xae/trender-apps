angular.module('trender')
.factory('PostService', ['$http', '$q', '$api', function ($http, $q, API){
    function _resolveData(p) {
        return p.then(function (resp) {
            return resp.data;
        });
    }

    function getData(conf) {
        var url = 'http://localhost:8983/solr/trender/query?q='+conf.q+
                  '&facet=true'+
                  '&facet.field=category'+
                  '&facet.field=type'+
                  '&rows=50';

         if (conf.fq) {
             url += '&fq=' + conf.fq;
         }

         return _resolveData($http.get(url));
    }

    return {
        getData: getData
    }
}]);
