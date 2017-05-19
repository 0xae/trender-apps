var TIMMING = 7000; // 7 seconds
var PAGINATION_DEEP = 20;

function getApiHost() {
    var idx = location.href.indexOf('trender');
    var host = location.href.substr(0, idx-1);
    var API = host + ':5000/';
    return 'http://127.0.0.1:5000/';
}

// XXX: remove later
function getProfileService() {
    var API = getApiHost();
    var obj = {
        getProfilesWithoutPictures: function() {
            return promisify($.get(API + 'profile/nopicture'));
        },

        updatePicture: function(id, picture) {
            return promisify($.put(API + 'profile/'+id+'/picture', picture));
        }
    };

    return obj;
}

function promisify(prms) {
    return new Promise(function (resolve, reject){
        prms.then(resolve, reject);
    });
}

function fetchNewsFeed() {
    //var f = document.body.childNodes[document.body.childNodes.length-1]
    var f = document.body.childNodes[7];
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
//         console.warn("skipping %o", domObj);
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
    var API = getApiHost();
    var q = $.ajax({
            url: API + "api/add_post", 
            method: "post", 
            data: JSON.stringify(p), 
            headers: {'Content-Type':'application/json'}
        });

    return new Promise(function (resolve, reject){
        q.then(resolve, reject);
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
function reload_frame(customLink) {
    var frame=document.createElement("frame");
    var f = document.body.childNodes[document.body.childNodes.length-1]
    if (customLink) {
        frame.setAttribute("src", customLink);
    } else {
        var moreStoriesLink = fetchNewsFeed()
                .parentElement
                .children[3]
                .attributes
                .href
                .value;
        var mainLink='https://free.facebook.com/home.php';
        if (pag_curr_level++ == PAGINATION_DEEP) {
            pag_curr_level = 1;
            frame.setAttribute("src", mainLink);
        } else {
            frame.setAttribute("src", moreStoriesLink);        
        }
        updatePag(pag_curr_level);
    }

    f.firstChild.remove();
    setTimeout(function(){
        f.appendChild(frame);        
    }, 500);
}

var totalCrawls = 0;
var should_stop = false;
var c = 1;
var pcWorkerId = 0;
var profiles = [];

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
               todo.push(prms);
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
    .then(indexingDone, indexingDone);
}

function indexingDone() {
    reload_frame();        
    console.info("--- indexing done ---");            
}

function resumeCrawler() {
    $("#resume").hide();
    $("#stop").show();
    should_stop = false;
    workerId = setInterval(indexPosts, TIMMING);
}

function stopCrawler() {
    $("#resume").show();
    $("#stop").hide();              
    should_stop = true;
    clearInterval(workerId);
}

function crawlPictures() {
    if (profiles.length == 0) {
        getProfileService()
        .getProfilesWithoutPictures()
        .then(function (data) {
            profiles = data;
            reload_frame('https://free.facebook.com/'+last(profiles).username);       
        })
        .then(__crawlP);
    } else {
        __crawlP();
    }
}

function last(ary) {
  return ary[ary.length-1];
}

var vk=0; // in_transaction?
// XXX: this function needs a better treatment
function __crawlP() {
    if (profiles.length == 0 || vk) {
        console.info("in transaction");
        return;
    }
      
    vk = 1;
    console.info("start crawling picture...");

    try {
        var el = document.body.children[document.body.children.length-1];
        var ary = $("img", el.children[0].contentDocument);
        var picture = ary[2].attributes.src.value;
        if (!picture) {
            console.warn("bad code! cant find picture!stopping all systems");
            stopPictureCrawler();
            return;
        }
        var p = profiles.pop();

        getProfileService()
        .updatePicture(p.id, picture)
        .then(function () {
            vk = 0;
            reload_frame('https://free.facebook.com/'+last(profiles).username);            
        }, function () {
            console.warn("problem on code. stopping systems");
            stopPictureCrawler();
            vk = 0;
        });        
    } catch (e) {
        vk = 0;
        console.info("too soon to land!");
        console.error(e);        

        if (isIt404()) {
            var l='https://free.facebook.com/'+last(profiles).username;
            console.info("going to " + l);
            profiles.pop();
            reload_frame(l);
        }
    }
}

function isIt404() {
    var el = document.body.children[document.body.children.length-1];
    var doc = el.children[0].contentDocument;

    var found=false;
    _foreach($("span.k", doc), function (n) {
        if (n.innerText=='The page you requested was not found.') {
            found=true;            
        }
    });    
    return found;
}

function resumePictureCrawler(){
    $("#rs_pc").hide();
    $("#st_pc").show();
    pcWorkerId = setInterval(crawlPictures, 6000);
}

function stopPictureCrawler(){
    $("#rs_pc").show();
    $("#st_pc").hide();
    stop_pc = true;
    clearInterval(pcWorkerId);
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
    document.write("<span id='resume' style='font-size:13px;color:green;text-decoration:underline;'> Start crawling...</span>");
    document.write("<span id='rs_pc' style='font-size:13px;color:green;text-decoration:underline;'> Crawl some pictures...</span>");
    document.write("<span id='st_pc' style='font-size:13px;color:red;display:none;text-decoration:underline;'> Stop crawling pictures...</span>");
    document.write("<span id='tcrw' style='margin-left:15px;font-weight:bold;font-size:15px;color:#ccc;'> 0 crawls today</span>");
    document.write("<span id='tcrk' style='margin-left:15px;font-weight:bold;font-size:15px;color:#ccc;'> 0 pags deep</span>");

    document.body.appendChild(fs);
    $("#resume").on("click", resumeCrawler);
    $("#stop").on("click", stopCrawler);    

    $("#rs_pc").on("click", resumePictureCrawler);    
    $("#st_pc").on("click", stopPictureCrawler);    
}, 500);


// XXX
function getProfileService() {
    var API = getApiHost();
    var obj = {
        getProfilesWithoutPictures: function() {
            return promisify($.get(API + 'profile/nopicture'));
        },

        updatePicture: function(id, picture) {
            return promisify(
                    $.ajax({
                        type:'post', 
                        url: API + 'profile/'+id+'/picture', 
                        data:picture,
                        headers: {'Content-Type':'application/json'}
                    })
              );
        }
    }

    return obj;
}

function promisify(prms) {
    return new Promise(function (resolve, reject){
        prms.then(resolve, reject);
    });
}
