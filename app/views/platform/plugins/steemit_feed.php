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
    <div class="col-md-12 " style="background-color:#000;height:430px">
        <div class="col-md-4" style="margin-top:25px;">
            <h4 style="font-size:13px;font-weight:bold;"> 
                showing #{{ top_mode }} <br/>
                about {{ total_items }} posts
            </h4>
            <div ng-repeat="post in top_posts" style="margin-bottom: 15px;">
                <steemit-top-post p="post">
                </steemit-top-post>
            </div>
        </div>

        <div class="col-md-6 pull-right" style="margin-top:25px;margin-right: 35px;">
            <div class="row">
                <div class="col-md-12" style="">
                    <h4 style="font-size:13px;font-weight:bold;"> 
                        Media 
                    </h4>
                </div>
                <!-- col-md-12 -->

                <div class="col-md-12" style="border-radius:2px;background-color:rgba(204, 204, 204, 0.25);">
                    <div class="row">
                        <div class="col-md-3 pull-left" style="">
                            <div class="" style="" ng-repeat="m in mediaData track by $index" ng-if="m.jdata.app_url">
                                <a href="#" class="top-media-item" ng-click="setMediaOutdoor(m)">
                                    <div class="" style="z-index:1000;" >
                                        <img class="media-pic-item media-object" 
                                            ng-src="{{ m.jdata.app_url }}" 
                                            style="z-index:0;" 
                                        />
                                        <div class="" style="">
                                            <span class="obfs media-pic-title"
                                                style="padding-left: 0px;">
                                                {{ m.jdata.time_fmt}}
                                            </span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="col-md-8" 
                            style="margin-top:10px;margin-bottom:10px;width:450px;height:300px;">
                            <div class="" 
                                style="position: absolute;top:72%;width:100%;">
                                <!--
                                <span class="obfs media-pic-title" style="font-size:13px;padding: 16px;">
                                    <span style="margin-right:5px;" class="pull-left">
                                        <img src="http://127.0.0.1/trender/media/full/b480c7224d9df9c388c8b1e0eec5167c2f3134fe.jpg" 
                                             style="border:3px solid #fff;border-radius:90px;width:42px;height:42px;"/>
                                    </span>
                                    Crypt0's News: $500,000 Bitcoin Within 3 Years...Wanna Bet? / CoinDash Site HACKED - ICO in Peril
                                </span>
                                -->
                            </div>
                            <img ng-src="{{ outdoor.background }}"
                                 style="width:450px;height:289px;" />
                        </div>

                        <!--
                        <div class="col-md-8" style="">
                             <iframe src="http://player.twitch.tv/?channel=yoda&muted=true"
                                 height="300" width="450" frameborder="0" scrolling="no"
                                 allowfullscreen="true">
                             </iframe>
                        </div>
                        -->
                    </div>
                </div>
            </div>
            <!-- col-md-12 -->
        </div>
    </div>

    <div class="col-md-12" style="background-color: #000;padding-bottom:10px;padding-top:23px;">
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

    <div class="col-md-5" style="margin-top: 25px;">
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
