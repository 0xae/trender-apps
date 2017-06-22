(function main() {
    var posts = $('#posts_list ul').children;
    _foreach(posts, getPostRequest);

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
        var likes = parseInt(footer.children[1].firstChild.innerText.trim());
        var postReaction = {
            countLikes: likes
        }

        // post-links code
        var postLink = {
            viewLink: postInfo.firstChild.getElementsByTagName("a")[0].href,
        }

        // post code
        var post = {
            description: postInfo.firstChild.getElementsByTagName("a")[0].innerText,
            postLink: postLink,
            postReaction: postReaction,
            timming: postInfo.firstChild.getElementsByTagName("a")[0].innerText,
            type: "post",
            facebookId: postLink.viewLink,
            profile: profile,
        }

        // TODO: get listing on which this post was created
        return {
            profile: profile,
            post: post        
        }
    }

    function _foreach(ary, callback) {
        for (var i=0; i<ary.length; i++) {
            var el = ary[i];
            callback(el);
        }
    }

    function toPromise(prms) {
        return new Promise(function (resolve, reject){
            prms.then(resolve, reject);
        });
    }
})()
