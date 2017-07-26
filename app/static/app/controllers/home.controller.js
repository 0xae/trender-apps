angular.module('trender')
.controller('HomeController', ['$scope', 'PostService', 'MediaService',  '$api',
function ($scope, postService, mediaService, $api){
    $scope.searchFor = function (q) {
        $scope.searchTerm = q;
        postService.search(q)
        .then(function (data){
           $scope.posts_search_results = data; 
           $scope.$apply();
        });
    }

    $scope.searchFor('news');
}]);
