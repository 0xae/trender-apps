function getProfileService() {
    var obj = {
        getProfilesWithoutPictures: function() {
            return promisify($.get('http://127.0.0.1:5000/profile/nopicture'));
        },

        updatePicture: function(id, picture) {
            return promisify(
                    $.ajax({
                        type:'post', 
                        url:'http://127.0.0.1:5000/profile/'+id+'/picture', 
                        data:picture,
                        headers: {'Content-Type':'application/json'}
                    })
              );
        }
    }

    return obj;
}


