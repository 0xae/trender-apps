angular.module('trender')
.controller('HomeController', ['$scope', 'PostService', '$api',
function ($scope, service, $api){
    $scope.search = function (q) {
        console.info("search for #"+q);
        if (!$scope.query)
            $scope.query = q;

        service.getData({q:q})
        .then(function (data){
            var postTypes = getTypesResume(data);
            var categories = getCategoryResume(data);

            $scope.posts = data.response.docs;
            categories = categories.filter(function (c){
                return c.value > 0;
            });
            var sorted = _.sortBy(categories, function (c) {
                return -parseInt(c.value);
            });

            $scope.top_categories = sorted.slice(0, 10);
            $scope.search_topic = q;
            $scope.remain_categories = sorted.slice(11, 17);
            $scope.type_result = _.sortBy(postTypes, function (p) {
                return p.value;
            });
            $scope.total_found = data.response.numFound;            
        });
    };

    $scope.searchByCategory = function (c) {
        $scope.fq = c.key;
        service.getData({
            q:$scope.query,
            fq: encodeURIComponent(c.key)
        })
        .then(function (data){
            $scope.posts = data.response.docs;
        });
    }

    $scope.searchByType = function (c) {
        var conf = {
            q:$scope.query,
            fq: '&fq=type:'+c.key
        };
        if ($scope.fq) conf.fq = conf.fq + '&fq'+encodeURIComponent($scope.fq)
        service.getData(conf)
        .then(function (data){
            $scope.posts = data.response.docs;
        });        
    }

    function getTypesResume(data) {
        var facets = data.facet_counts.facet_fields.type;
        var result = [];
        
        if (facets.length > 0) {
            for (var i=0; i<facets.length-1; i+=2) {
                var k=facets[i];
                var v=facets[i+1];
                result.push({
                    "key": k,
                    "value": v
                });
            }
        }        

        return result;
    }

    function getCategoryResume(data) {
        var categoryFacets = data.facet_counts.facet_fields.category;
        var category = [];
        if (categoryFacets.length > 0) {
            for (var i=0; i<categoryFacets.length-1; i+=2) {
                var k=categoryFacets[i];
                var v=categoryFacets[i+1];

                if (/[a-zA-Z]/.test(k)) {
                    category.push({
                        "key": k,
                        "value": v
                    });
                }
            }
        }

        return category;
    }

    $scope.search('bitcoin');
}]);
