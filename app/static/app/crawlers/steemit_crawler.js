(function (exports, document) {
    var tries = 3;
    var jobId;

    exports.StopCrawler = function () {
        clearInterval(jobId);
    }

    exports.StartCrawler = function () {
        jobId = setInterval(Crawl, 4000);
    }

    function Crawl() {
        var queue = [];
        var posts=document.getElementById("posts_list").firstChild.children;
        _foreach(posts, function (p){
            var req = getPostRequest(p);
            queue.push(createPost(req));
        });

        Promise.all(queue)        
        .then(function () {
           tries = 3;
           console.log("[INFO] Done crawling ");
           _go();
        }, function () {
            console.warn("[WARN] Humm, something went wrong");
            tries += 1;
            if (tries == 3) { _go(); }
        });
    }

    function _go() {
       var topic = GetRandomTopic();
       console.log("[LOG] " + 
                     new Date() + 
                     " going for #" + 
                     topic.innerText);
        if (topic) {
           topic.click();            
        }
    }

    function GetRandomTopic() {
        var topics = document.getElementsByClassName('PostsIndex__topics')[0];
        var links = topics.getElementsByTagName("a");
        var index = parseInt(Math.random() * links.length);
        var topic = links[index];
        if (topic && topic.href && topic.innerText!='Show more topics..')
            return topic;
    }

    function getPostRequest(_rawPost) {
        var footer = _rawPost.firstChild.getElementsByClassName('PostSummary__footer')[0];
        var footerDetails = footer.getElementsByClassName('show-for-medium')[0].firstChild;
        var postInfo = _rawPost.firstChild.lastChild;

        // profile code
        var profile = {
            username: footerDetails.children[1].firstChild.innerText,
            title: footerDetails.children[1].firstChild.innerText,
            link: footerDetails.children[1].firstChild.href,
        };

        // listing code
        var listing = {            
            link: footerDetails.children[2].firstChild.href,
            name: footerDetails.children[2].firstChild.innerText
        };

        // post-reaction code
        // TODO: countShares, countComments
        var postReaction = {
            countLikes: parseInt(footer.children[1].firstChild.innerText.trim())
        };

        // post-links code
        var postLink = {
            viewLink: postInfo.firstChild.getElementsByTagName("a")[0].href,
            commentLink: postInfo.firstChild.getElementsByTagName("a")[0].href,
            shareLink: postInfo.firstChild.getElementsByTagName("a")[0].href
        };

        // post code
        // TODO: timming
        var post = {
            description: postInfo.firstChild.getElementsByTagName("a")[0].innerText,
            postLink: postLink,
            postReaction: postReaction,
            timming: 'Just now',
            type: "post",
            facebookId: postLink.viewLink,
        };

        // TODO: get listing on which this post was created
        return {
            profile: profile,
            post: post        
        };
    }

    function createPost(post) {
        var opts = {
            method: 'POST',
            body: JSON.stringify(post),
            headers: {'Content-Type' : 'application/json'},
        };
     
        return fetch('http://127.0.0.1:5000/api/add_post', opts)
        .then(function (response) {
          return response.json();
        });
    }

    var profile = null;
    function CrawlPictures() {
        if (profile) {
            var st = document.getElementsByClassName("Userpic")[1].attributes.style;
            var picUrl = (/url\((.*)\)/.exec(st.value)[1]).replace(/"/g,'');
            var userId = profile.id;
            profile = null;

            fetch('http://127.0.0.1:5000/profile/'+userId+'/picture', {
                body:picUrl,
                method: 'POST',
                headers: {'Content-Type':'application/json'}
            }).then(function () {
                console.log("Update done...");
            });       
        } else {
            fetch('http://127.0.0.1:5000/profile/nopicture', {method:'GET', header:{'Content-Type':'application/json'}})
            .then(function (response) {
                response.json()
                .then(function (data){
                if (!data.length) return;
                    profile = data.pop();                    
                });
            });
        }
    }

    function getNoPictureProfiles() {
        return fetch('http://127.0.0.1:5000/profile/nopicture')
        .then(function (response) {
          return response.json();
        });
    }

    function _foreach(ary, callback) {
        for (var i=0; i<ary.length; i++) {
            var el = ary[i];
            callback(el);
        }
    }

    function last(ary) {
      return ary[ary.length-1];
    }
})(window, document)