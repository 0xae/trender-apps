<div class="row" ng-controller="PostController" style="margin-top: 25px;">
<div class="col-md-6" >
    <span id="steemit_title"></span>
    <div class="media" ng-repeat="p in posts">
          <div class="media-left">
            <a href="#">
              <img class="media-object" ng-src="{{ p.picture }}" alt="Foto of {{p.author.name}}" width="70" height="50"/>
            </a>
          </div>
          <div class="media-body">
            <h4 class="st-post-author" style="display: inherit;">{{ p.author.title }}
                <a href="#" style="font-size:11px;padding: 0px;padding-right:3px;color:#777;text-decoration:none;font-weight:normal;">
                 · {{ p.post_time }} 
                </a>
            </h4>
            <p style="margin-bottom:5px;font-size:13px;">{{ p.description }} </p>
            <ul class="nav nav-pills">
                <li role="presentation" class="">
                    <a href="#" style="font-size:12px;padding: 0px;padding-right:3px;">
                        <img style="display:inline-block;padding:0px;" src="static/img/like.png" width="13" height="13" class="o">
                        {{ p.postReaction.countLikes }} 
                    </a>
                </li>

                <li role="presentation" class="">
                    <a target="__blank" href="{{ p.postLink.viewLink" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">
                    · <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">like</span>
                    </a>
                </li>
                <li role="presentation" class="">
                    <a target="__blank" href="{{ p.postLink.commentLink }}" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">
                     · <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">comment</span>
                    </a>
                </li>
                <li role="presentation" class="color: #777">
                    <a target="__blank" href="{{ p.postLink.viewLink }}" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">
                     ·  <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">full story</span>
                    </a>
                </li>
            </ul>
          </div>
    </div>
    </div>

    <div class="col-md-6">
        <div class="row">
          <div class="col-md-7">
            <button type="button" class="btn btn-sm btn-success" ng-if="stoped" ng-click="toggleStreamming()">Resume</button>
            <button type="button" class="btn btn-sm btn-danger" ng-if="!stoped"ng-click="toggleStreamming()">Stop</button>
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
