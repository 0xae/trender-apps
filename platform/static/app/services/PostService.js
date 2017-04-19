function getPostService() {
    var obj = {
        getPostById: function (id) {
            return promisify($.get('http://127.0.0.1:5000/post/'+id));
        },

        getPostByFbId: function (fbid) {
            return promisify($.get('http://127.0.0.1:5000/post/fbid/'+fbid));
        },

        getRecentPosts: function (time) {
            var url = 'http://127.0.0.1:5000/api/recent_posts';
            if (time) {
                var timef = decodeURIComponent(time); 
                url = url + "?time="+ timef;
            }
            return promisify($.get(url));
        }
    };

    return obj;
}

