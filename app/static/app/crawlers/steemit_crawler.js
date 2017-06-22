(function main() {
    var posts = $('#posts_list ul').children;
    _foreach(posts, function (p){
        var req = getPostRequest(p);
        createPost(req)
        .then(function (data) {
            console.info(data);
        });
    });

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
        }

        // post-links code
        var postLink = {
            viewLink: postInfo.firstChild.getElementsByTagName("a")[0].href,
            commentLink: postInfo.firstChild.getElementsByTagName("a")[0].href,
            shareLink: postInfo.firstChild.getElementsByTagName("a")[0].href
        }

        // post code
        // TODO: timming
        var post = {
            description: postInfo.firstChild.getElementsByTagName("a")[0].innerText,
            postLink: postLink,
            postReaction: postReaction,
            timming: 'Just now',
            type: "post",
            facebookId: postLink.viewLink,
        }

        // TODO: get listing on which this post was created
        return {
            profile: profile,
            post: post        
        }
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

    function _foreach(ary, callback) {
        for (var i=0; i<ary.length; i++) {
            var el = ary[i];
            callback(el);
        }
    }

    function _toPromise(prms) {
        return new Promise(function (resolve, reject){
            prms.then(resolve, reject);
        });
    }
})()