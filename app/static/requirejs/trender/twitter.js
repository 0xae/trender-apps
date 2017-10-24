define("trender/twitter", ["trender/app", "trender/crawler"], 
function (app, crawler){
    function start() {
        var fs = crawler.makeFrameset("twitter1", "https://twitter.com");
        document.body.appendChild(fs);
    };

	return {
		start: start
	}
});