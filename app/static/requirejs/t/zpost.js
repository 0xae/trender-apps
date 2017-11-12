define(['trender/app', 'jquery'], 
function (app, $){
    function updateCollection (op, postId, collectionName) {
        var url = app.api() + "post/" + postId + "/" + op + "/collection/" + collectionName;
        return new Promise(function (resolve, reject){
            $.ajax({
                url: url,
                type: "post",
                success: function (data) { 
                    resolve(data); 
                },
                error: function (error) { 
                    reject(error.responseText);
                }
            });             
        });
    };

    return {
        addTo: function (postId, collectionName) {
            return updateCollection('add', postId, collectionName);
        },
        removeFrom: function (postId, collectionName) {
            return updateCollection('remove', postId, collectionName);
        },
    	downloadPic: function (postId) {    	
			var url = app.api() + "post/media/" + postId + "/download";
			return new Promise(function (resolve, reject){
				$.ajax({
	                url: url,
	                type: "get",
	                success: function (data) { 
	                	resolve(data); 
	                },
	                error: function (error) { 
	                    reject((error.responseText));
	                }
	            });				
			});
    	}
    };
});
