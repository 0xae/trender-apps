angular.module('trender')
.controller('PostController', ['$scope', 'PostService', function ($scope, postService){
    var time=moment()
             .subtract(5, 'days')
             .format("YYYY-MM-DD HH:mm:ss");

    function formatTime(time) {
        var m=moment(time);
        var today = moment();
        
        if (today.format("YYYY-MM-DD") == m.format("YYYY-MM-DD")) {
            return m.format("h:mm:ssa");
        } else {
            return m.format("MMM DD YYYY, h:mm:ssa");
        }
    }

    /**
       * @see https://stackoverflow.com/questions/487073/check-if-element-is-visible-after-scrolling
    */
    function isElVisible(element, fullyInView) {
        var pageTop = $(window).scrollTop();
        var pageBottom = pageTop + $(window).height();
        var elementTop = $(element).offset().top;
        var elementBottom = elementTop + $(element).height();

        if (fullyInView === true) {
            return ((pageTop < elementTop) && (pageBottom > elementBottom));
        } else {
            return ((elementTop <= pageBottom) && (elementBottom >= pageTop));
        }
    }

    function fetchPosts () {
        if (!isElVisible($("#steemit_title"), false)) {
            console.info("not loading...");
            return;            
        }

        postService.stream(time)
        .then(function (data) {
            data.forEach(function (p) {
               p.post_time = formatTime(p.timestampFmt); 
            });

            if (data.length) {
                last = data[0].timestampFmt; 
                if ($scope.posts) {
                    $scope.posts = data.concat($scope.posts);
                } else {
                    $scope.posts = data;                    
                }            
            }
        });
    }

    fetchPosts();
    setInterval(fetchPosts, 5000);
}]);
