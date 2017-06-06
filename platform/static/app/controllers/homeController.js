angular.module("trender")
.controller("HomeController", ['$scope', function ($scope) {
    var postService = getPostService();
    var postTemplate = null;
    var last = null;
    var bc = new BrandController();
    var workerId;

    function fetchTemplate() {
        if (postTemplate) {
            return;
        }

        return promisify($.get('./post.php')
        .then(function (data) { 
            postTemplate = _.template(data);
        }));
    }

    var last=null;
    function fetchPosts () {
        var time=null;
        if (last!=null) {   
            time = moment(last)
                   .add('1', 'second')
                   .format("YYYY-MM-DD HH:mm:ss");     
        }

        return postService.getRecentPosts(time)
        .then(function (data) {
            bc.reloadView(data);
            return data;
        });
    }

    function replaceLinks(descr) {
        var regex = /(\s*(\w+\.\w+[\w+\.\w+]*)\s*)+/g;
        var r = regex.exec(descr);
        var ret = descr;

        if (r) {
            var chunks = r[0].split(' ');
            chunks.forEach(function (s) {
                var l = 'http://'+s;
                ret = ret.replace(s, '<a href="'+l+'">'+s+'</a>');
            });
        }

        return ret;
    }

    function update_fetched(count) {
        $("#post_count").text(count);
        $("#posts_loader").show('slow');
    }

    function hide_loader() {
        $("#posts_loader").hide();        
    }

    var should_i_run=1;
    function loadRecentPosts(append) {
        if (!should_i_run) return;
        fetchPosts()
        .then(function (data) {
            var total=data.length;
            if (total>0 && total < 20) {
                update_fetched(total);
            }

            if (total) {
                last = data[0].timestampFmt;
            }            

            setTimeout(function(){
                data.forEach(function(post){
                    post.description = post.description.trim().replace(/\n/g, '<br/>');
                    if (!post.description || post.description == '<br/>') return;
                    post.description = replaceLinks(post.description);
                    var ns=postTemplate({post: post});
                    var node=$(ns);
                    $(node).attr("style", "display: none;");
                    if (append) {
                        $("#posts_container").append(node);
                    } else {
                        $("#posts_loader").after(node);
                    }
                    node.show('slow');
                });            

                hide_loader();
            }, 2000);
        });
    }

    fetchTemplate()
    .then(function () {
        loadRecentPosts(true);
         workerId = setInterval(loadRecentPosts, 5000);
    });
}]);

