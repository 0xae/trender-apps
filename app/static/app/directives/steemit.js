angular.module('trender')
.directive('steemitPost', function (){
    return {
        restrict: "E",
        scope: {p: '='},
        template: '<div class="media">'+
                '      <div class="media-left">'+
                '        <a href="#">'+
                '          <img class="media-object" ng-src="{{ p.picture }}" alt="Foto of {{p.author.name}}" width="70" height="50"/>'+
                '        </a>'+
                '      </div>'+
                '      <div class="media-body">'+
                '        <h4 class="st-post-author" style="display: inherit;">{{ p.author.title }}'+
                '            <a href="#" title="{{ p.timestampFmt }}" style="font-size:11px;padding: 0px;padding-right:3px;color:#777;text-decoration:none;font-weight:normal;">'+
                '             · {{ p.post_time }} '+
                '            </a>'+
                '        </h4>'+
                '        <p style="margin-bottom:5px;font-size:13px;">{{ p.description }} </p>'+
                '        <ul class="nav nav-pills">'+
                '            <li role="presentation" class="">'+
                '                <a href="#" style="font-size:12px;padding: 0px;padding-right:3px;">'+
                '                    <img style="display:inline-block;padding:0px;" src="static/img/like.png" width="13" height="13" class="o">'+
                '                    {{ p.postReaction.countLikes }} '+
                '                </a>'+
                '            </li>'+
                '            <li role="presentation" class="">'+
                '                <a target="__blank" href="{{ p.postLink.viewLink" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">'+
                '                · <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">like</span>'+
                '                </a>'+
                '            </li>'+
                '            <li role="presentation" class="">'+
                '                <a target="__blank" href="{{ p.postLink.commentLink }}" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">'+
                '                 · <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">comment</span>'+
                '                </a>'+
                '            </li>'+
                '            <li role="presentation" class="color: #777">'+
                '                <a target="__blank" href="{{ p.postLink.viewLink }}" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">'+
                '                 ·  <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">full story</span>'+
                '                </a>'+
                '            </li>'+
                '            <li role="presentation" class="color: #777">'+
                '                <a target="__blank" href="{{ p.postLink.viewLink }}" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">'+
                '                 ·  <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">'+
                                        '<img src="static/img/steemit-196x196.png" style="display:inline;width:15px;height:15px;" /> steemit.com'+
                                  '</span>'+
                '                </a>'+
                '            </li>'+
                '        </ul>'+
                '      </div>'+
                '</div>'
    }
})

.directive('trenderPost', function (){
    return {
        restrict: "E",
        scope: {p: '='},
        template: '<div class="media">'+
                '      <div class="media-left">'+
                '        <a href="#">'+
                '          <img class="media-object" ng-src="{{ p.picture }}" alt="Foto of {{p.authorName}}" width="70" height="50"/>'+
                '        </a>'+
                '      </div>'+
                '      <div class="media-body">'+
                '        <h4 class="st-post-author" style="display: inherit;">{{ p.authorName }}'+
                '            <a href="#" title="{{ p.timestampFmt }}" style="font-size:11px;padding: 0px;padding-right:3px;color:#777;text-decoration:none;font-weight:normal;">'+
                '             · {{ p.timestamp }} '+
                '            </a>'+
                '        </h4>'+
                '        <p style="margin-bottom:5px;font-size:13px;">{{ p.description }} </p>'+
                '        <ul class="nav nav-pills">'+
                '            <li role="presentation" class="">'+
                '                <a href="#" style="font-size:12px;padding: 0px;padding-right:3px;">'+
                '                    <img style="display:inline-block;padding:0px;" src="static/img/like.png" width="13" height="13" class="o">'+
                '                    {{ 0 }} '+
                '                </a>'+
                '            </li>'+
                '            <li role="presentation" class="color: #777">'+
                '                <a target="__blank" href="{{ p.link }}" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">'+
                '                 ·  <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">'+
                                        '<img src="static/img/steemit-196x196.png" style="display:inline;width:15px;height:15px;" /> {{p.source}}'+
                                  '</span>'+
                '                </a>'+
                '            </li>'+
                '        </ul>'+
                '      </div>'+
                '</div>'
    }
})

.directive('twitterPost', function (){
    return {
        restrict: "E",
        scope: {p: '='},
        template: '<div class="media">'+
                '      <div class="media-left">'+
                '        <a href="#">'+
                '          <img style="border-radius:88px" class="media-object" ng-src="{{ p.picture }}" alt="Foto of {{p.authorName}}" width="50" height="50"/>'+
                '        </a>'+
                '      </div>'+
                '      <div class="media-body">'+
                '        <h4 class="st-post-author" style="display: inherit;">'+
                            '@{{ p.json.username }}'+
                '            <a href="#" title="{{ p.timestampFmt }}" style="font-size:11px;padding: 0px;padding-right:3px;color:#777;text-decoration:none;font-weight:normal;">'+
                '             · {{ p.timestamp }} '+
                '            </a>'+
                '        </h4>'+

                '        <p style="margin-bottom:5px;font-size:13px;padding:4px;">{{ p.description }} </p>'+
                         '<div class="" ng-if="p.json.images.length">'+
                            '<div class="col-md-12">'+
                               '<a href="#" class="" style="border:0px;">'+
                                   '<img style="border-radius:4px;height:200px;width:300px;" ng-src="{{p.json.images[0]}}" alt="...">'+
                               '</a>'+
                          '</div>'+
                        '</div>'+

                '        <ul class="nav nav-pills">'+
                '            <li role="presentation" class="">'+
                '                <a href="#" style="font-size:12px;padding: 4px;padding-right:3px;">'+
                '                    <img style="display:inline-block;padding:0px;" src="static/img/like.png" width="13" height="13" class="o">'+
                '                    {{ p.json.love }} '+
                '                </a>'+
                '            </li>'+
                '            <li role="presentation" class="color: #777">'+
                '                <a target="__blank" href="{{ p.link }}" style="color:#777;font-size:12px;padding: 4px;padding-right:3px;">'+
                '                 ·  <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">'+
                                        '<img src="static/img/twitter-192x192.png" style="display:inline;width:15px;height:15px;" /> twitter.com'+
                                  '</span>'+
                '                </a>'+
                '            </li>'+
                '        </ul>'+
                '      </div>'+
                '</div>'
    }
})

.directive('youtubePost', function (){
    return {
        restrict: "E",
        scope: {p: '='},
        template: '<div class="media">'+
                '      <div class="media-left">'+
                '        <a href="#">'+
                '          <img style="border-radius:88px" class="media-object" ng-src="{{ p.picture }}" alt="Foto of {{p.authorName}}" width="50" height="50"/>'+
                '        </a>'+
                '      </div>'+
                '      <div class="media-body">'+
                '        <h4 class="st-post-author" style="display: inherit;">'+
                            '{{ p.authorName }}'+
                '            <a href="#" title="{{ p.timestampFmt }}" style="font-size:11px;padding: 0px;padding-right:3px;color:#777;text-decoration:none;font-weight:normal;">'+
                '             · {{ p.timestamp }} '+
                '            </a>'+
                '        </h4>'+
                '        <p style="margin-bottom:5px;font-size:13px;padding:4px;">{{ p.description }} </p>'+
                         '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<iframe id="ytplayer" style="border:0px;border-radius:4px" type="text/html" width="300" height="200"'+
                                    'src="https://www.youtube.com/embed/j23HnORQXvs&autoplay=0'+
                                    'frameborder="0">'+
                                '</iframe>'+
                          '</div>'+
                        '</div>'+

                '        <ul class="nav nav-pills">'+
                '            <li role="presentation" class="">'+
                '                <a href="#" style="font-size:12px;padding: 4px;padding-right:3px;">'+
                '                    <img style="display:inline-block;padding:0px;" src="static/img/like.png" width="13" height="13" class="o">'+
                '                    {{ p.json.love }} '+
                '                </a>'+
                '            </li>'+
                '            <li role="presentation" class="color: #777">'+
                '                <a target="__blank" href="{{ p.link }}" style="color:#777;font-size:12px;padding: 4px;padding-right:3px;">'+
                '                 ·  <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">'+
                                        '<img src="static/img/youtube-medium.png" style="display:inline;width:15px;height:15px;" /> youtube.com'+
                                  '</span>'+
                '                </a>'+
                '            </li>'+
                '        </ul>'+
                '      </div>'+
                '</div>'
    }
})

.directive('trClock', function (){
    return {
        restrict: "E",
        template: '<span class="Icon clock space-right" style="display: inline-block; width: 1.12rem; height: 1.12rem;"><svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve"><g><path d="M255.988,32C132.285,32,32,132.298,32,256c0,123.715,100.285,224,223.988,224C379.703,480,480,379.715,480,256 C480,132.298,379.703,32,255.988,32z M391.761,391.765c-10.099,10.098-21.126,18.928-32.886,26.42l-15.946-27.62l-13.856,8 l15.955,27.636c-24.838,13.03-52.372,20.455-81.027,21.624V416h-16v31.825c-28.656-1.166-56.191-8.59-81.03-21.62l15.958-27.641 l-13.856-8l-15.949,27.625c-11.761-7.492-22.79-16.324-32.889-26.424c-10.099-10.099-18.93-21.127-26.422-32.889l27.624-15.949 l-8-13.855L85.796,345.03c-13.03-24.839-20.454-52.374-21.621-81.03H96v-16H64.175c1.167-28.655,8.592-56.19,21.623-81.029 l27.638,15.958l8-13.856l-27.623-15.948c7.492-11.76,16.322-22.787,26.419-32.885c10.1-10.101,21.129-18.933,32.89-26.426 l15.949,27.624l13.856-8l-15.958-27.64C191.81,72.765,219.345,65.34,248,64.175V96h16V64.176 c28.654,1.169,56.188,8.595,81.026,21.626l-15.954,27.634l13.856,8l15.945-27.618c11.76,7.492,22.787,16.323,32.886,26.421 c10.1,10.099,18.931,21.126,26.424,32.887l-27.619,15.946l8,13.856l27.636-15.956c13.031,24.839,20.457,52.373,21.624,81.027H416 v16h31.824c-1.167,28.655-8.592,56.189-21.622,81.028l-27.637-15.957l-8,13.856l27.621,15.947 C410.693,370.637,401.861,381.665,391.761,391.765z"></path><path d="M400,241H284.268c-2.818-5.299-7.083-9.708-12.268-12.708V160h-32v68.292c-9.562,5.534-16,15.866-16,27.708 c0,17.673,14.327,32,32,32c11.425,0,21.444-5.992,27.106-15H400V241z"></path></g></svg></span>'
    }
})

.directive('steemitTopPost', function (){
    return {
        restrict: "E",
        scope: {p: '='},
        template: '<div class="media">'+
                '      <div class="media-left">'+
                '        <a href="#">'+
                '          <img class="media-object" ng-src="{{ p.picture }}" alt="Foto of {{p.author.name}}" width="70" height="50"/>'+
                '        </a>'+
                '      </div>'+
                '      <div class="media-body">'+
                '        <h4 class="st-post-author" style="color:#167ac6;display: inherit;">{{ p.author.title }}'+
                '            <a href="#" style="font-size:11px;padding: 0px;padding-right:3px;color:#25981e;text-decoration:none;font-weight:normal;">'+
                '             · {{ p.post_time }} '+
                '            </a>'+
                '        </h4>'+
                '        <p style="margin-bottom:5px;font-size:13px;color:#e2dede">{{ p.description }} </p>'+
                '        <ul class="nav nav-pills">'+
                '            <li role="presentation" class="">'+
                '                <a href="#" style="font-size:12px;padding: 0px;padding-right:3px;">'+
                '                    <img style="display:inline-block;padding:0px;" src="static/img/like.png" width="13" height="13" class="o">'+
                '                    {{ p.postReaction.countLikes }} '+
                '                </a>'+
                '            </li>'+
                '        </ul>'+
                '      </div>'+
                '</div>'
    }
})

