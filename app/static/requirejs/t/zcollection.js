define(['trender/app', 'jquery'], 
function (app, $){
    const api = app.api();
    return {
        save: function (data) {
            return new Promise(function (resolve, reject){
                var str = JSON.stringify(data);
                if (data.id) {
                    url = api + "collection/" + data.id;
                    mth = "put";
                } else {
                    url = api + "collection/new";
                    mth = "post";
                }

                $.ajax({
                    url: url,
                    type: mth,
                    headers:{
                        "Content-type": "application/json"
                    },
                    data: str,
                    success: function (data) {
                        resolve(data);
                    },
                    error: function (error) {
                        reject(JSON.parse(error.responseText));
                    }
                });
            });
        }
    };
});
