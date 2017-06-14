function getPostService() {
    var API = getApiHost();
    var obj = {
        getPostById: function (id) {
            return promisify($.get(API + 'post/'+id));
        },

        getPostByFbId: function (fbid) {
            return promisify($.get(API + 'post/fbid/'+fbid));
        },

        getRecentPosts: function (time) {
            var url = API + 'api/recent_posts';
            if (time) {
                var timef = decodeURIComponent(time); 
                url = url + "?time="+ timef;
            }
            return promisify($.get(url));
        }
    };

    return obj;
}


