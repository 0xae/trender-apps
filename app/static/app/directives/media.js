angular.module('trender')
.directive('mediaImage', function (){
    return {
        restrict: "E",
        scope: {post: '=', media: '='},
    }
})

.directive('mediaVideo', function (){
    return {
        restrict: "E",
        scope: {post: '=', media: '='},
    }
})

.directive('mediaListing', function (){
    return {
        restrict: "E",
        scope: {
            data: '='
        }
    }
})
