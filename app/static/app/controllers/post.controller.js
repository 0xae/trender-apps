angular.module('trender')
.controller('PostController', ['$scope', 'PostService', function ($scope, postService){
    $scope.context = 'home';
    $scope.top_posts = null;
    $scope.stoped = false;
    var time=moment()
             .subtract(5, 'days')
             .format("YYYY-MM-DD HH:mm:ss");


    $scope.toggleStreamming = function () {
        $scope.stoped = !$scope.stoped;
    }

    $scope.setContext = function (context) {
        $scope.context = context;
        console.info("switch to context: ",  context);
    }

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
        if (!isElVisible($("#steemit_title"), false) || $scope.stoped) {
            console.info("not loading...");
            return;            
        }

        postService.stream(time, 10)
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

                var sorted = _.sortBy($scope.posts, function (p){
                    return -p.postReaction.countLikes;
                });

                $scope.top_posts = sorted.slice(0, 4).map(function (p) {
                   p.description_f = p.description;
                   if (p.description.length > 90) {
                       p.description_f = p.description.substr(0, 90) + "...";
                   }
                   return p;
                });

                console.info($scope.top_posts);
            }
        });
    }

    fetchPosts();
    setInterval(fetchPosts, 5000);
}]);
