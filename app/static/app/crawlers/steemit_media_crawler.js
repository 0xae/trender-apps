(function(){
    var profile = null;
    function CrawlPictures() {
        if (profile) {
            var st = document.getElementsByClassName("Userpic")[1].attributes.style;
            var picUrl = (/url\((.*)\)/.exec(st.value)[1]).replace(/"/g,'');
            var userId = profile.id;
            profile = null;

            fetch('http://127.0.0.1:5000/profile/'+userId+'/picture', {
                body:picUrl,
                method: 'POST',
                headers: {'Content-Type':'application/json'}
            }).then(function () {
                console.log("Update done...");
            });
        } else {
            fetch('http://127.0.0.1:5000/profile/nopicture', {method:'GET', header:{'Content-Type':'application/json'}})
            .then(function (response) {
                response.json()
                .then(function (data){
                if (!data.length) return;
                    profile = data.pop();
                });
            });
        }
    }

    function getNoPictureProfiles() {
        return fetch('http://127.0.0.1:5000/profile/nopicture')
        .then(function (response) {
          return response.json();
        });
    }    
})();
