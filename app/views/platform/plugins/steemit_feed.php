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

</style>

<div class="row" ng-controller="PostController" >
    <div class="col-md-12 " style="background-color:#000;height:340px">
        <div class="col-md-4" style="margin-top: 25px;">
            <div ng-repeat="post in top_posts" style="margin-bottom: 15px;">
                <steemit-top-post p="post">
                </steemit-top-post>
            </div>
        </div>

        <div class="col-md-8">
        </div>
    </div>

    <div class="col-md-12" style="background-color: #000;padding-top:20px;">
          <div class="pull-left"> 
              <ul class="nav nav-tabs" style="border:0px;" role="tablist">
                    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Home</a></li>
                    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Profile</a></li>
                    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Messages</a></li>
                    <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab">Settings</a></li>
              </ul>
          </div>

        <div class="pull-right">
            <button type="button" class="btn btn-sm btn-success" ng-if="stoped" ng-click="toggleStreamming()">resume</button>
            <button type="button" class="btn btn-sm btn-danger" ng-if="!stoped"ng-click="toggleStreamming()">stop</button>
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

            <div style="">
                 <iframe
                     src="http://player.twitch.tv/?channel=yoda&muted=true"
                     height="220"
                     width="250"
                     frameborder="0"
                     scrolling="no"
                     allowfullscreen="true">
                 </iframe>
             </div>
          </div>
        </div>
    </div>
</div>
