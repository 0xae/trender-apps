define(['trender/app', 'jquery'], 
function (app, $){
    const api = app.api();

    function default_fetch(url) {
        return new Promise(function (resolve, reject){
            fetch(url)
            .then(function (data) {
                data.json()
                .then(resolve, reject);
            });
        });
    }

    function getById(id) {
        return default_fetch(api+'channel/'+id);
    }

    function getAll() {
        var url = api + 'channel/';
        return default_fetch(url);
    }

    function getCollections(id) {
        var url = api + "channel/"+id+"/collections";

    }

    function create(data) {
        var url = api + "channel/new";
        return $.ajax({
            url: url,
            method: 'POST',
            data: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        });
    }

    function update(data) {
        var url = api + "channel/" + data.id;
        return $.ajax({
            url: url,
            method: 'PUT',
            data: JSON.stringify(data),
            headers: {
                'Content-Type': 'application/json'
            }
        });

    }

    function deleteChannel(id) {
        var url = api + "channel/"+id+"/delete";
        return $.ajax({
            url: url,
            method: 'POST'
        });
    }

    return {
        getById: getById,
        getAll: getAll,
        create: create,
        update: update,
        collections: getCollections,
        delete: deleteChannel,
    };
});
