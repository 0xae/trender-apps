/**
 * Steemit Crawler
 * TODO:
 *  [X] get timming / send timestamp instead of timming ? 
 *  [ ] refresh page once for while to get brand new posts
 *  [ ] scroll page on crawling
 *  [ ] send post listing (which may be multiple)

 * NOTES:
 *  % steemit posts can have many tags (how do we adapt that to listings)
 *  % i am so dandy today
*/
(function (exports, document) {
    var tries = 3;
    var jobId;

    Crawl();

    exports.StopCrawler = function () {
        clearInterval(jobId);
    }

    exports.StartCrawler = function () {
        jobId = setInterval(Crawl, 4000);
    }

    exports.Crawl = function () {
        return Crawl();
    }

    function Crawl() {
        var queue = [];
        var posts=document.getElementById("posts_list").firstChild.children;

        // as a dom node, p is
        _foreach(posts, function (p){
            var req = getPostRequest(p);
            queue.push(createPost(req));
        });

        Promise.all(queue)        
        .then(function () {
           tries = 3;
           INFO("Done crawling ");
           _go();
        }, function () {
            WARN("Humm, something went wrong");
            tries += 1;
            if (tries == 3) { 
                _go(); 
            }
        });
    }

    function _go() {
        var topic = GetRandomTopic();
        LOG("going for #" +  topic.innerText)
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

        var profile = {
            username: footerDetails.children[1].firstChild.innerText,
            title: footerDetails.children[1].firstChild.innerText,
            link: footerDetails.children[1].firstChild.href
        };

        var listing = {            
            link: footerDetails.children[2].firstChild.href,
            name: footerDetails.children[2].firstChild.innerText
        };

        // TODO: countShares, countComments
        var postReaction = {
            countLikes: parseInt(footer.children[1].firstChild.innerText.trim())
        };

        // FIXME: steemit doesnt have comments and share links, how do we handle that?
        var viewLink=postInfo.firstChild.getElementsByTagName("a")[0].href;
        var postLink = {
            viewLink: viewLink,
            commentLink: viewLink,
            shareLink: viewLink
        };

        var postDate = footerDetails.children[0].firstChild.title;
        var post = {
            description: postInfo.firstChild.getElementsByTagName("a")[0].innerText,
            postLink: postLink,
            postReaction: postReaction,
            timestamp: new Date(postDate).getTime(),
            timming: postDate,
            type: "post",
            facebookId: postLink.viewLink,
        };

        // TODO: get listing(s) on which this post was created
        return {
            profile: profile,
            post: post,       
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

    function LOG(msg) {
       console.log("[LOG] " + new Date(), msg);  
    }

    function WARN(msg) {
       console.warn("[INFO] " + new Date(), msg);  
    }

    function INFO(msg) {
       console.info("[INFO] " + new Date(), msg);  
    }

    function ASSERT(cond, msg) {
        if (!cond) {
            msg = msg || "Assertion error";
            throw new Error(msg);
        }
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