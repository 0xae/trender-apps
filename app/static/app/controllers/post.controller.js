angular.module('trender')
.controller('PostController', ['$scope', 'PostService', 'MediaService',  '$api',
function ($scope, postService, mediaService, $api){
    var TIMELINE_MAX_POSTS = 35;
    var POST_PER_REQUEST = 4;
    var MAX_TOP_PICS=9;

    $scope.context = 'home';
    $scope.top_posts = null;
    $scope.stoped = false;
    $scope.posts = [];
    $scope.sliderPos = 0;

    var daysAgo = parseInt(localStorage.getItem('tm_start_day') || 2);
    var time=moment()
//      .subtract(1, 'days')
     .format("YYYY-MM-DD HH:mm:ss");

    $scope.toggleStreamming = function () {
        $scope.stoped = !$scope.stoped;
    };

    $scope.setContext = function (context) {
        $scope.context = context;
    };

    $scope.outdoor = {
        background: "http://127.0.0.1/trender/media/full/44dc074bfd10c79209eb736390566695bafd953e.jpg",
        text: "",
        avatar: "",
        href: "#"
    };

    $scope.setMediaOutdoor = function (m) {
        $scope.outdoor = {
            background: m.jdata.app_url,
            text: m.post.description,
            avatar: m.post.picture,
            author: m.post.author.username,
            href: m.post.postLink.viewLink,
            tag: m.listing.title,
            time: m.jdata.time_fmt
        };

        // with jquery this is faster
        $("#outdoor_img").attr("src", $scope.outdoor.background);
    };

    function updateUI() {
        if (/*!isElVisible($("#steemit_title"), false) ||*/ $scope.stoped) {
            return;            
        }

        postService.stream(time, POST_PER_REQUEST)
        .then(function (data) {
            if (data.length > 0) {
                data.forEach(function (p) {
                    p.post_time = $api.formatPostTime(p.timestampFmt); 
                });

                if ($scope.posts.length > TIMELINE_MAX_POSTS) {
                    $scope.posts.splice($scope.posts.length-POST_PER_REQUEST);
                }

                var allPosts = _.sortBy($scope.posts.concat(data), function (e) {
                    return -moment(e.timestampFmt).toDate().getTime();
                });

                $scope.posts = allPosts;

                var req = filterTop(data, 0, POST_PER_REQUEST)
                .map(function (pm){
                    return {
                        fId: pm.facebookId,
                        postId: pm.id,
                        links: [pm.postLink.viewLink]
                    };
                });

                mediaService.index(req);
                postService.cache(data);
            }
        })
        .finally(function () {
             postService.getCache()
            .then(updateTopPosts);
             updateMedia();            
        });
    }

    // XXX: bad design
    var cache=[], offset=0;
    var mediaFilterTime=moment()
     .subtract(2, 'days')
     .format("YYYY-MM-DD HH:mm:ss");

    function updateMedia() {
        if ($scope.stoped) return;

        mediaService.recent(mediaFilterTime, null, null, offset)
        .then(function (data){
            $scope.loading=false;
            cache = cache.concat(data);
            offset += 30;

            updateMediaOutdoor();
        });
    }

    var last=0;

    function updateMediaOutdoor() {
        if ($scope.stoped) return;

        if (last%MAX_TOP_PICS==0) {
            $scope.mediaData = cache.slice(last, last+MAX_TOP_PICS);
        }

        var media = cache[last];
        $scope.setMediaOutdoor(media);
        last++;
        if (last >= cache.length) {
            last = 0;
        }
    }

    function apply() {
        try{$scope.$apply();}catch(e){}
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
        var unique = _.uniqBy(posts, function (p) { return p.id; });
        return  _.sortBy(unique, function (p) {
                   return p.postReaction.countLikes;
                })
                .slice(start, end);
    }

    /**
     * https://stackoverflow.com/questions/487073/check-if-element-is-visible-after-scrolling
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
        var ret=[lastOne, lastOne+POST_PER_REQUEST];        
        lastOne += POST_PER_REQUEST;
        return ret;
    }

    updateUI();
    setInterval(updateUI, 5000);
}]);
