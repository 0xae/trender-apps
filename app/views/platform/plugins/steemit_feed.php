<style>
ul.nav li.active a {
    background-color: #337ABC;
    color: rgba(250,249,250,0.62);
    border:0px;
    background-color: #337ABC;
    color: rgba(250,249,250,0.62);
}
.nav-tabs > li > a {
    margin-right: 2px;
    line-height: 1.42857143;
    border: 1px solid transparent;
    border-radius: 8px 8px 8px 8px;
    padding: 0px 8px;
    font-size: 11px;
    font-weight: bold;
}

.nav-tabs > li.active > a:focus,
.nav-tabs > li.active > a:hover {
    background-color: #337ABC;
    color: rgba(250,249,250,0.62);
    border:0px;
    background-color: #337ABC;
    color: rgba(250,249,250,0.62);
}
.media-pic-item {
    width: 150px;
    height: 90px;
    z-index:0;
}
.media-pic-title {
    color: #fff;
    background-color: transparent;
    font-size: 12px;
    z-index: 100;
}

.obfs {
    background: -moz-linear-gradient(top, rgba(255,255,255,0) 0%, rgba(0,0,0,0.4) 100%);
    background: -webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(0,0,0,0.4) 100%);
    background: linear-gradient(to bottom, rgba(255,255,255,0) 0%,rgba(0,0,0,0.4) 100%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00ffffff', endColorstr='#66000000',GradientType=0 );
    opacity: 1;
}

a.top-media-item img {
    border: 4px solid #000;
    border-radius: 3px;
}

a.top-media-item:hover img {
    border-color: #fff;
}
</style>

<div class="row" ng-controller="PostController" >
    <div class="col-md-12" style="padding-top:50px;background-color:#000;">
        <div class="col-md-4" style="">
            <h4 style="font-size:13px;font-weight:bold;"> 
                showing #{{ top_mode }} <br/>
                about {{ total_items }} posts
            </h4>
            <div ng-repeat="post in top_posts" style="margin-bottom: 15px;">
                <steemit-top-post p="post">
                </steemit-top-post>
            </div>
        </div>

        <div class="col-md-3">
        </div>

        <div class="col-md-4" style="">
            <h4 style="font-size:13px;font-weight:bold;"> 
                Media 
            </h4>

            <div style="display:table;background-color:rgba(204, 204, 204, 0.17);border: 1px solid #000; border-bottom: 0px;padding: 4px;border-radius:3px;">
                 <a href="#" ng-repeat="m in mediaData track by $index" 
                    ng-if="m.jdata.app_url"
                    ng-click="setMediaOutdoor(m);">
                    <img ng-src="{{ m.jdata.app_url }}" 
                        style="width:50px;height:40px;display:inline;z-index:0;" 
                    />
                </a>
            </div>

            <div style="border:3px solid #666;margin-top:6px;border-radius:2px;padding:0px;background-color:#000;z-index:1000;">
                <a style="margin-top:0px;" href="{{outdoor.href}}" target=_blank>
                    <center>
                        <img id="outdoor_img" 
                             style="margin-top:12px;width:406px;z-index:1;height:234px;" 
                        />
                    </center>
                </a>

                <div style="padding: 15px;">
                    <p style="padding:7px;padding-bottom:1px;margin-bottom:1px;font-size:13px;color: #ccc;">
                        {{ outdoor.text }} 
                    </p>

                    <img src="static/img/steemit-196x196.png" style="display:inline;width:15px;height:15px;" />
                    <h4 class="st-post-author" style="color: #ccc;display: inline;">
                         {{outdoor.author}}
                    </h4>
                    <h4 class="st-post-author" style="color: #ccc;font-weight:normal;display: inline;"> in </h4>
                    <h4 class="st-post-author" style="color: #ccc;display: inline;">
                         {{outdoor.tag}}
                    </h4>

                    <div class="pull-right">
                        <span style="color:#888;font-size:10px;" class="glyphicon glyphicon-time"></span>
                        <span style="color:#999;font-size:11px;font-weight:bold;">{{ outdoor.time }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8" style="border-radius:2px;padding:0px;">
                <!--
                <div class="col-md-8" style="">
                     <iframe src="http://player.twitch.tv/?channel=yoda&muted=true"
                         height="300" width="450" frameborder="0" scrolling="no"
                         allowfullscreen="true">
                     </iframe>
                </div>
                -->
        </div>
    <!-- col-md-12 -->
    </div>

    <div class="col-md-12" style="background-color: #000;padding-bottom:10px;padding-top:23px;padding-left:25px;">
          <div class=""> 
              <ul class="nav nav-tabs" style="border:0px;" role="tablist">
                    <li role="presentation" ng-class="{active: context=='home'}">
                        <a href="#home" ng-click="setContext('home');" aria-controls="home" role="tab" data-toggle="tab">what's happening</a>
                    </li>

                    <li role="presentation" ng-class="{active: context=='media'}">
                        <a href="#profile" ng-click="setContext('media');" aria-controls="profile" role="tab" data-toggle="tab">
                            <span style="color:#d9534f;">tv</span>/media
                        </a>
                    </li>

                    <li role="presentation" ng-class="{active: context=='market'}">
                        <a href="#settings" ng-click="setContext('market');" aria-controls="settings" role="tab" data-toggle="tab">market</a>
                    </li>
                    <!--
                    <li role="presentation" ng-class="{active: context=='settings'}">
                        <a href="#settings" ng-click="setContext('settings');" aria-controls="settings" role="tab" data-toggle="tab">settings</a>
                    </li>
                    -->

                    <li role="presentation" ng-class="{active: context=='bitcoin'}">
                        <a href="#messages" ng-click="setContext('bitcoin');" aria-controls="messages" role="tab" data-toggle="tab">#bitcoin</a>
                    </li>

                    <li role="presentation" ng-class="{active: context=='news'}">
                        <a href="#messages" ng-click="setContext('news');" aria-controls="messages" role="tab" data-toggle="tab">#news</a>
                    </li>

                    <!-- buttons to the right -->
                    <li class="pull-right" ng-if="stoped" ng-click="toggleStreamming()" role="presentation">
                        <a style="background-color: #5cb85c;color:#fff;margin-right:24px;" href="#settings" aria-controls="settings" role="tab" data-toggle="tab">
                            resume
                        </a>
                    </li>

                    <li class="pull-right" ng-if="!stoped" ng-click="toggleStreamming()" role="presentation">
                            <a href="#settings" 
                               style="background-color: #d9534f;color:#fff;font-size:11px;margin-right:24px;" 
                               aria-controls="settings" 
                               role="tab" data-toggle="tab">
                            stop
                        </a>
                    </li>
              </ul>
          </div>
    </div>

    <div class="col-md-5" style="padding:10px;margin-left:35px;margin-top: 15px;">
        <span id="steemit_title"></span>
        <div ng-repeat="post in posts track by $index" style="margin-bottom: 25px;">
            <steemit-post p="post">
            </steemit-post>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
              <div class="col-md-7 pull-right">
                <div class="">
                    <h4 class="st-post-author pull-left" style="display: inherit;color: #ccc;">
                        Most liked
                    </h4>
                </div>
              </div>
        </div>
    </div>
</div>
