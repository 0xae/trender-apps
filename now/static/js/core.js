const TIMMING = 7000; // 7 seconds
const PAGINATION_DEEP = 20;

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
    //var f = document.body.childNodes[document.body.childNodes.length-1]
    var f = document.body.childNodes[5];
    var doc = f.children[0].contentDocument;
    var ct = doc.getElementById("m_newsfeed_stream");

    if (ct) {
        // home page
        return ct.children[2];
    } else {
        // stories page
        // return $("div[data-ft]").parentElement || ($("div[data-ft]").parent()[0]);
        // m-top-of-feed
        return doc.getElementById("m-top-of-feed").nextSibling ;
    }            
}

function fetchPosts() {
    var f = document.body.childNodes[5];
    var doc = f.children[0].contentDocument;
    var posts = $.find("div[role='article']", doc);
    
    if (!posts || posts.length == 0) {
        console.warn("[ERROR] no posts found, verify if the frame contains a valid page!");
    }
    return posts;
}

function getPostRequest(domObj) {
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

    var timming = (articleActivity.getElementsByTagName("abbr")[0].innerText);

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
    var description = "<unknown>";
    var coverHtml = null;
    if (articleInfo.children[2]) {
        description = articleInfo.children[2].innerText;
        coverHtml = articleInfo.children[2].innerHTML;
    }

    // post activity data (likes, timming, audience, ...)
    var timmingAndAudience = articleActivity.children[0];
    var linksAndReactions = articleActivity.children[1];
    var links = linksAndReactions.getElementsByTagName("a");

    var postLink = {};
    var postReaction = {};

    for (var i=0; i<links.length; i++) {
        var l = links[i];
        var href = l.attributes.href.value;
        var text = l.innerText;
        if (/Like/i.test(text)) {
        } else if (/Comment/i.test(text)) {
            postLink.commentLink = href;
        } else if (/Share/.test(text)) {
            postLink.shareLink = href;
        } else if (/Full Story/.test(text)) {
            postLink.viewLink = href;
        } else if (/\d+/.test(text)) {
            postReaction.countLikes = parseInt(text);
        }
    }

    var _name = entityLink.substr(1);
    var idx = _name.indexOf("/");
    if (idx == -1) {
        idx = _name.indexOf("?");
    }
    var username = _name.substr(0, idx);

    if (username == 'profile.php') {
        username = _name.substring(_name.indexOf("=")+1, _name.indexOf("&"))
    }

    var profile = {
        username: username,
        title: entityName,
        link: entityLink
    };

    var post = {
        description: description,
        coverHtml: coverHtml,
        type: "post",
        timming: timming,
        facebookId: facebookId,
        postReaction: postReaction,
        postLink : postLink,
    };

    var request = {
        profile: profile,
        post: post        
    }

    return request;
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

function createPost(p) {
    return $.ajax({
            url: "http://127.0.0.1:5000/timeline/listing/1/add_post", 
            method: "post", 
            data: JSON.stringify(p), 
            headers: {'Content-Type':'application/json'}
        });
}

// log success for promises
function _logS(i) { console.info(i); }

// log error for promises
function _logE(i) { console.error(i); }

function updateCrawls(count) {
    $("#tcrw").text("~" + count + " new crawls");
}

function updatePag(count) {
    $("#tcrk").text(count + "/"+PAGINATION_DEEP+" pages deep");
}

var pag_curr_level = 0;
function reload_frame() {
    var frame=document.createElement("frame");
    var mainLink='https://free.facebook.com/home.php';
    var f = document.body.childNodes[document.body.childNodes.length-1]
    var moreStoriesLink = fetchNewsFeed()
            .parentElement
            .children[3]
            .attributes
            .href
            .value;

    if (pag_curr_level++ == PAGINATION_DEEP) {
        pag_curr_level = 1;
        frame.setAttribute("src", mainLink);
    } else {
        frame.setAttribute("src", moreStoriesLink);        
    }
    updatePag(pag_curr_level);

    f.firstChild.remove();
    setTimeout(function(){
        f.appendChild(frame);        
    }, 500);
}

var totalCrawls = 0;
var should_stop = false;
var c = 1;

function indexPosts() {
    if (should_stop) {
        return;
    }
    var posts = fetchNewsFeed();
    var todo = [];
    if (!posts || !posts.childNodes) { 
        // too soon
        console.log("too soon");
        return;
    }

    _foreach(posts.childNodes, function (node) {
        try {
            var p = getPostRequest(node);
            if (p) {
               var prms = createPost(p)
                          .then(function (ok){ updateCrawls(c++); console.info("post #"+p.post.facebookId+" created!"); },
                             function (err){ console.error(err); })
               todo.push(toPromise(prms));
            }  else {
               console.warn("[WARN] Found bad post. Skipping: ", node);
            }
        } catch (e) {
            // skip
            console.error(e);
        }
    });

    // turn your lights down low...
    Promise.all(todo)
    .then(function () {
        reload_frame();  
        console.info("--- indexing done ---");        
    }, function () {
        reload_frame();        
        console.info("--- indexing done ---");        
    });
}

setTimeout(function(){
    var workerId;
    var fs=document.createElement("frameset");
    var frame=document.createElement("frame");
    var link='https://free.facebook.com/home.php';
    frame.setAttribute("src", link);
    fs.appendChild(frame);

    document.write("<span style='margin-right: 15px;'>Trender Now!</span>");
    document.write("<span id='stop' style='display:none;font-size:13px;color:red;text-decoration:underline;'>Stop crawling...</span>");
    document.write("<span id='resume' style='font-size:13px;color:green;text-decoration:underline;'>Start crawling...</span>");
    document.write("<span id='tcrw' style='margin-left:15px;font-weight:bold;font-size:15px;color:#ccc;'>0 crawls today</span>");
    document.write("<span id='tcrk' style='margin-left:15px;font-weight:bold;font-size:15px;color:#ccc;'>0 pags deep</span>");

    document.body.appendChild(fs);
    $("#resume").on("click", function () {
        $("#resume").hide();
        $("#stop").show();
        should_stop = false;
        workerId = setInterval(indexPosts, TIMMING);    
    });

    $("#stop").on("click", function () {
        $("#resume").show();
        $("#stop").hide();              
        should_stop = true;
        clearInterval(workerId);
    });    
}, 500)
