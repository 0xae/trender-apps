angular.module('trender')
.controller('PostController', ['$scope', 'PostService', 'MediaService', 
function ($scope, postService, mediaService){
    var TIMELINE_MAX_POSTS = 20;
    var POST_PER_REQUEST = 4;

    $scope.context = 'home';
    $scope.top_posts = null;
    $scope.stoped = false;
    $scope.posts = [];
    var time=moment()
             .subtract(5, 'days')
             .format("YYYY-MM-DD HH:mm:ss");

    $scope.toggleStreamming = function () {
        $scope.stoped = !$scope.stoped;
    }

    $scope.setContext = function (context) {
        $scope.context = context;
    }

    function updateUI() {
        if (/*!isElVisible($("#steemit_title"), false) ||*/ $scope.stoped) {
            return;            
        }

        postService.stream(time, POST_PER_REQUEST)
        .then(function (data) {
            if (data.length > 0) {
                data.forEach(function (p) {
                    p.post_time = formatTime(p.timestampFmt); 
                });
                
                // TODO: work on this later
                var all=data.concat($scope.posts);
                if (all.length > TIMELINE_MAX_POSTS) {
                    $scope.posts = all.slice(0, TIMELINE_MAX_POSTS);
                } else {
                    $scope.posts = $scope.posts.concat(all);
                }

                var req = filterTop(data, 0, POST_PER_REQUEST)
                .map(function (pm){ 
                    return {
                        fId: pm.facebookId,
                        postId: pm.id,
                        links: [pm.postLink.viewLink]
                    };
                });

                mediaService.index(req);
                postService.cache(all);
            }
        });

         postService.getCache()
        .then(updateTopPosts);
         updateMedia();
    }

    // XXX: bad design
    function updateMedia() {
        if ($scope.loading) return;
        mediaService.recent()
        .then(function (data){
            $scope.loading=false;
        });
    }

    function updateTopPosts(posts) {
        var r=nextInterval();
        var topPosts = filterTop(posts, r[0], r[1]);
        if (r[0] > topPosts.length) {
            resetInterval();
        }
 
        $scope.total_items = posts.length;
        $scope.top_mode = 'top-'+(r[0]+r[1]);
        $scope.top_posts = topPosts;
    }

    function filterTop(posts, start, end) {
        var sorted = _.sortBy(posts, function (p) {
           return p.postReaction.countLikes;
        });

        return _.uniqBy(sorted, function (p) { return p.id; }).slice(start, end);
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

    var lastOne=0;
    function resetInterval() {
        lastOne=0;
    }
    function nextInterval() {        
        var ret=[lastOne, lastOne+3];        
        lastOne += 3;
        return ret;
    }

    updateUI();
    setInterval(updateUI, 5000);
}]);
