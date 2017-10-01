(function(w, d){
    function reloadFrame(customLink) {
        var frame=d.createElement("frame");
        var f = d.body.childNodes[document.body.childNodes.length-1]
        frame.setAttribute("src", customLink);
        f.firstChild.remove();
        setTimeout(function(){
            f.appendChild(frame);        
        }, 500);
    }

    function createPostMedia(object) {
        var conf = {
            method: 'POST',
            body: JSON.stringify(object),
            headers: {'Content-Type' : 'application/json'}
        };
     
        return fetch('http://127.0.0.1:5000/api/add_post_media', conf)
        .then(function (response) {
          return response.json();
        });
    }

    var index=null;
    function fetchPostFromIndex() {
        if (!index || index.length==0) {
            return new Promise(function (resolve, reject){
                fetch('http://127.0.0.1:5000/api/media/to_index')
                .then(function (response){
                    response.json()
                    .then(function (data){
                        index = data;
                        if (index.length > 0)
                            resolve(index.pop());
                        else
                            reject('No Post');
                        console.info("index is ", index);
                    }, reject);
                });
            });
        } else {            
            return new Promise(function (resolve, reject){
                if (index.length > 0)
                    resolve(index.pop());
                else
                    reject('No Post');
            });
        }
    }

    function Run() {
        fetchPostFromIndex()
        .then(function (postLink){
            console.info("[INFO] reloading ", postLink);
            reloadFrame(postLink);
        });
    }

    d.write("<span style='margin-right: 15px;'>Trender Now!</span>");
    d.write("<span id='stop' style='display:none;font-size:13px;color:red;text-decoration:underline;'>Stop crawling...</span>");
    w.Run = Run;
})(window, document);
