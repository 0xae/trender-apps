function customizeProfile() {
    // remove the question about where i am
    $("div.eh").remove();

    // the menu with 'About . Friends . Photos . Likes . Following . Activity Log'
    $("div.cp").remove();

    // remove the 'Edit Profile Picture'
    $("div.ch").remove();

    // deal with the footer
}

function fetchNewsFeed() {
    return $("div[data-ft]").parentElement;
}

function parsePost(domObj) {
    // XXX: handle more than 3 children
    // XXX: add support to events (may be something)
    var role = domObj.attributes.role;
    if (domObj.childElementCount != 2 || (!role || role.value != 'article')) {
        console.warn("skipping %o", domObj);
        return null;
    }

    // article info (title, entity, description, cover, ...)
    var articleInfo = domObj.children[0];

    // article activity (reactions, links, ...)
    var articleActivity = domObj.children[1];

    // entity data
    var entity = articleInfo.firstChild.getElementsByTagName("a")[0];
    var entityName = entity.innerText;
    var entityLink = entity.attributes.href.value;

    // fb data
    var fbData = JSON.parse(domObj.attributes['data-ft'].value);
    var facebookId = fbData.mf_story_key;
    var qid = fbData.qid;
    var topLevelPostId = fbData.top_level_post_id;

    // title/description/cover data
    var title = articleInfo.children[1].innerText;
    var description = "";
    var coverHtml = null;
    if (articleInfo.children[2]) {
        description = articleInfo.children[2].innerText;
        coverHtml = articleInfo.children[2].innerHTML;
    }

    // post activity data (likes, timming, audience, ...)
    var timmingAndAudience = articleActivity.children[0];
    var linksAndReactions = articleActivity.children[1];
    var links = linksAndReactions.getElementsByTagName("a");

    var postActivity = {};
    var postReaction = {};

    for (var i=0; i<links.length; i++) {
        var l = links[i];
        var href = l.attributes.href.value;
        var text = l.innerText;
        if (/Like/i.test(text)) {
        } else if (/Comment/i.test(text)) {
            postActivity.commentLink = href;
        } else if (/Share/.test(text)) {
            postActivity.shareLink = href;
        } else if (/Full Story/.test(text)) {
            postActivity.viewLink = href;
        } else if (/\d+/.test(text)) {
            postReaction.countLikes = parseInt(text);
        }
    }

    var entity = {
        name: entityName,
        link: entityLink
    };

    var obj = {
        title: title,
        description: description,
        htmlData: domObj.innerHTML,
        coverHtml: coverHtml,
        facebookId: facebookId,
        type: "post",
        entityLink: entityLink,
        postActivity : postActivity,
        postReaction: postReaction,
        //_element: domObj,
        //entity: entity
    };

    return obj;
}

function indexPosts() {
    var newsFeed = fetchNewsFeed();
    newsFeed.childNodes
    .forEach(function (node) {
        try {
            var p = parsePost(node);
            if (p) {
                createPost(p)
                .then(function (ok){ console.info("post #"+p.facebookId+" created!"); },
                      function (err){ console.error(err); })
            }  else {
                console.warn("[WARN] Found bad post. Skipping: ", node);
            }
        } catch (e) {
            // skip
        }
    });
}

function createPost(p) {
    return $.ajax({
            url: "http://127.0.0.1:5000/listings/1/general/add_post", 
            method: "post", 
            data: p, 
            headers: {'Content-Type':'application/json'}
        });
}

function loadPosts(listingId, listingName) {
    return $.ajax({
            url: "http://127.0.0.1:5000/listings/"+listingId+"/"+listingName+"/posts", 
            method: "get", 
            headers: {'Content-Type':'application/json'}
        });
}

function timelineNow() {
    // http://127.0.0.1:5000/listings/1/now
    return $.ajax({
            url: "http://127.0.0.1:5000/listings/1/now", 
            method: "get", 
            headers: {'Content-Type':'application/json'}
        });    
}

function getPost(facebookId) {
    // http://127.0.0.1:5000/post/view?fbid=1483019234245572801
    return $.ajax({
            url: "http://127.0.0.1:5000/post/view?fbid="+facebookId, 
            method: "get", 
            headers: {'Content-Type':'application/json'}
        });
}

// log success for promises
function _logS(i) { console.info(i); }

// log error for promises
function _logE(i) { console.error(i); }
