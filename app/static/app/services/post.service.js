angular.module('trender')
.factory('PostService', ['$http', '$q', '$api', function ($http, $q, API){
    function _resolveData(p) {
        return p.then(function (resp) {
            return resp.data;
        });
    }

    function getData(conf) {
        var q = encodeURIComponent(conf.q);
        var url = 'http://localhost:8983/solr/trender/query?q='+q+
                  '&facet=true'+
                  '&facet.field=category'+
                  '&facet.field=type'+
                  '&rows=120'+
                  '&sort=timestamp desc';

         if (conf.fq) {
             url += '&fq=' + conf.fq;
         }

         return $http.get(url)
         .then(function (resp){
             var data = resp.data.response.docs;
             data.forEach(function (d){
                 d.json = JSON.parse(d.data);
             });          
             return resp.data;
         });
    }

    return {
        getData: getData
    }
}]);
