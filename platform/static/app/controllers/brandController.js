function BrandController(env) {
    this.TEMPLATE = '<table style="display:inline"><tbody><tr><td><img class="brand-picture" id="{{conf.object_id}}" src="{{conf.object_image}}" style="width: 35px;" /></td><td style="display: hidden"><span id="{{conf.object_id}}_not" class="alarm-syrene"></span></td></tbody></table>';
    this.COMPILE = _.template(this.TEMPLATE);
    this.env = env || {};
    this.db = {};
    this.inited = false;
    this.maxBrands = this.env.maxBrands || 47;
    this.count = 0;
}

function makeConfig(p) {
    var config = {
        object_id: p.author.id,
        object_image: p.author.picture,
        points: 1,
        posts: [p]
    };
    return config;
}

BrandController.prototype.showSyrene = function (id, stay) {
    setTimeout(function() {
        $("#"+id+"_not").hide();
        setTimeout(function () {
            $("#"+id+"_not").show();
            setTimeout(function () {
                $("#"+id+"_not").hide();
            }, 2000);
        }, 700);
    }, 800);
}

BrandController.prototype.initializeWall = function (posts, update) {
    var db = this.db;
    var TEMPLATE = this.TEMPLATE;
    var self = this;
    var r = posts.filter(function (p) {
        if (!p.author.picture) { 
            return false;
        }

        if (db[p.author.id]) {
            var config = db[p.author.id];
            config.points += 1;
            config.posts = [p].concat(config.posts);
            config.lastActivity = moment();
            self.showSyrene(p.author.id, true);
            return false;
        } else {
            var config = makeConfig(p);
            db[p.author.id] = config;
            config.lastActivity = moment();
            var html = _.template(TEMPLATE)({conf: config});
            $("#brands_container").append($(html));
            self.showSyrene(p.author.id);
            return true;
        }
    });

    this.count += r.length;
    if (this.count > this.maxBrands) {
        this.inited = true;
    }
}

BrandController.prototype.updateWall = function (posts) {
    if (posts.length==0) return;
    var db = this.db;
    var randomIdx = _.random(0, posts.length-1);
    var ps = Object.keys(this.db).map(function (k) {return db[k];});
    var sorted = _.sortBy(ps, function (p) { return p.lastActivity.toDate().getTime();});

    sorted.forEach(function (p,index) {

    });
}

BrandController.prototype.reloadView = function (posts) {
    if (posts.length == 0)  {
        return;
    }

    if (!this.inited) {
        this.initializeWall(posts);
    } else {
        this.updateWall(posts);
    }
}

