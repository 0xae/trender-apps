angular.module('trender')
.controller('HomeController', ['$scope', 'PostService', '$api',
function ($scope, service, $api){
    $scope.openWebpage = function (url) {
        $scope.webpage_url = url;
        console.info("openning ", url);
        $('#webpageModal').modal();        
    }
}]);
