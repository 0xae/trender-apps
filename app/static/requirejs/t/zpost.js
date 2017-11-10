define(['trender/app', 'jquery'], 
function (app, $){
    return {
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
