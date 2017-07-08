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

</style>

<div class="row" ng-controller="PostController" >
    <div class="col-md-12 " style="background-color:#000;height:285px">
        <div class="col-md-4" style="">
            <h4 style="font-size:13px;font-weight:bold;"> showing #{{ top_mode }} <br/>
                about {{ total_items }} posts</h4>
            <div ng-repeat="post in top_posts" style="margin-bottom: 15px;">
                <steemit-top-post p="post">
                </steemit-top-post>
            </div>
        </div>

        <div class="col-md-8">
            <div style="" class="pull-right">
                 <iframe
                     src="http://player.twitch.tv/?channel=yoda&muted=true"
                     height="300"
                     width="450"
                     frameborder="0"
                     scrolling="no"
                     allowfullscreen="true">
                 </iframe>
             </div>
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
        <div ng-repeat="post in posts" style="margin-bottom: 25px;">
            <steemit-post p="post">
            </steemit-post>
        </div>
    </div>

    <div class="col-md-6">
        <div class="row">
          <div class="col-md-7 pull-right">
            <div class="">
                <h4 class="st-post-author pull-left" style="display: inherit;color: #ccc;">
                    Twitch.Tv
                </h4>

                <span class="pull-right" style="margin-top:7px;font-size:11px;color:#777;background-color:#eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;"> <div class="live-indicator"></div> LIVE </span>
            </div>

          </div>
        </div>
    </div>
</div>
