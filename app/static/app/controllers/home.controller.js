angular.module('trender')
.controller('HomeController', ['$scope', 'PostService', '$api',
function ($scope, service, $api){
    service.getData('bitcoin')
    .then(function (data){
        console.info(data);
        var categoryFacets = data.facet_counts.facet_fields.category;
        var category = {};
        if (categoryFacets.length > 0) {
            for (var i=0; i<categoryFacets.length-1; i++) {
                var k=categoryFacets[i];
                var v=categoryFacets[i+1];

                if (/[a-zA-Z]/.test(v))                
                    category[k] = v;
            }


            console.log(category);
        }
    });
}]);
