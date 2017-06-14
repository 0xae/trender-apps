angular.module("trender")
.controller("SearchController", ['$scope', function ($scope) {
    console.info("buya...")
    $scope.doSearch = function (query) {
        console.info("search for ", query);
    }

    $scope.startedSearch = function () {
        console.info("start");
        $scope.show_search_res = true;
    }

    $scope.dismissSearch = function () {
        console.info("dismisss");
        $scope.show_search_res = false;
    }
}]);

function iamOut() {
    console.log("yee");

}
