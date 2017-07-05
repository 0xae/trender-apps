<h1>Steemit Feed</h1>

<div class="col-md-6" ng-controller="PostController">

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
                <a href="{{ p.postLink.viewLink" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">
                · like
                </a>
            </li>
            <li role="presentation" class="">
                <a href="{{ p.postLink.commentLink }}" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">
                 · comment
                </a>
            </li>
            <li role="presentation" class="color: #777">
                <a href="{{ p.postLink.viewLink }}" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">
                 · full story
                </a>
            </li>
        </ul>
      </div>
    </div>

</div>
