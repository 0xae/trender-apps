angular.module('trender')
.controller('HomeController', ['$scope', 'PostService', 'MediaService',  '$api',
function ($scope, postService, mediaService, $api){
    $scope.searchFor = function (q) {
        console.info('searching for ', '#'+q);
        $scope.searchTerm = q;
    }
}]);
