define("trender/crawler", ["trender/app"], function() {
    return {
        makeFrameset: function(id, link) {
            var fs=document.createElement("frameset");
            var frame=document.createElement("frame");
            frame.setAttribute("src", link);
            fs.setAttribute("id", id);
            fs.appendChild(frame);
            return fs;
        }
    };
})