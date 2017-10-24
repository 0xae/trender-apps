define("trender/twitter", ["trender/app", "trender/crawler", "jquery", "md5"], 
function (app, crawler, $, md5){
	const TWEETS_PER_REQUEST = 20;
    function start() {
        var fs = crawler.makeFrameset("twitter1", "https://twitter.com");
        document.body.appendChild(fs);
    }

    var stream = $("#timeline .stream");
    var loadMore = $(".js-new-tweets-bar");
    $("ol#stream-items-id");

    function crawlHomePage() {
        var posts = $("ol#stream-items-id li.stream-item");
    }    

    function processTweet(tweet) {
        var name = tweet.getElementsByClassName("fullname")[0].innerText;
        var link = "https://twitter.com/" + tweet.querySelector(".tweet").attributes["data-permalink-path"].value;
        var description = tweet.querySelector(".tweet-text").innerText;

        var tags=[], ary = tweet.querySelectorAll(".tweet-text a.twitter-hashtag b");
        for (var i = 0; i < ary.length; i++) {
            tags.push(ary[i]);
        }

        var tweetId = tweet.attributes["data-item-id"].value;
        var picture = tweet.getElementsByClassName("js-action-profile-avatar")[0].src;
        var username = tweet.querySelector(".content .username b").innerText;
        var images=[], imgs=tweet.querySelectorAll(".content .AdaptiveMediaOuterContainer img");
        for (var i=0; i<imgs.length; i++) {
            images.push(imgs[i].src);
        }

        var videos = [];
        var timestamp = tweet.querySelector(".tweet-timestamp span._timestamp").attributes["data-time-ms"].value;
        var data = {
            replies: tweet.querySelectorAll(".ProfileTweet-actionCountForPresentation")[0].innerText || 0,
            retweet: tweet.querySelectorAll(".ProfileTweet-actionCountForPresentation")[1].innerText || 0,
            love: tweet.querySelectorAll(".ProfileTweet-actionCountForPresentation")[3].innerText || 0,
            images: images,
            videos: videos,
            tweetId: tweetId
        };

        return {
            id: md5(link),
            description: description,
            type: "twitter-post",
            authorName: name,
            authorPicture: picture,
            source: "twitter.com",
            link: link,
            location: "worldwide",
            timestamp: timestamp,
            picture: picture,
            data: JSON.stringify(data),
            category: tags
        }
    }

	return {
		start: start
	}
});