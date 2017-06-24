<div role="article" class="dg di ds" data-fbid="{{ post.facebookId }}" data-ft="{&quot;qid&quot;:&quot;6407839477907729974&quot;,&quot;mf_story_key&quot;:&quot;4599740846053082244&quot;,&quot;top_level_post_id&quot;:&quot;1453932187960466&quot;}" id="u_{{ post.id }}">
<div>
    <div>
        <div class="by bz ca" style="width:50px;float: left; margin-right: 5px;">
            <a class="cb" 
               href="/techinsider/photos/a.398898576975171.1073741827.352751268256569/699090756955950/?type=3&amp;source=45&amp;refid=17" 
               style="width:50px; height: 50px;"
               title="Profile picture of Tech Insider">
                <img src="{{post.picture}}" 
                     width="50" 
                     height="50" 
                     class="" 
                     alt="Post Picture">
            </a>
        </div>
        <div style="">
            <h3 class="dt dm" style="display: inline-block">
                <span>
                    <strong> <a href="https://free.facebook.com/{{ post.author.link }}">{{ post.author.title }}</a> </strong>
                </span>
            </h3>
        </div>
    </div>
    <div class="du" style="">
        <span> <p> {{ post.description }} </p> </span>
    </div>

    <div class="el">
        <div class="k cv"> <abbr>{{ post.timming }}</abbr> </div>
        <div class="k cv">
            <a class="" aria-label="" href="{{ post.postLink.viewLink }}">
                <img style="display:inline-block;padding:0px;" src="https://z-m-static.xx.fbcdn.net/rsrc.php/v3/yC/r/9RmeZ1lDDHz.png" width="13" height="13" class="o">
                {{ post.postReaction.countLikes }} 
            </a>
            <span aria-hidden="true">· </span>
            <a href="{{ post.postLink.viewLink }}">Like</a>
            <span aria-hidden="true">· </span>
            <a class="en" href="{{ post.postLink.commentLink }}">Comment</a>
            <span aria-hidden="true">· </span>
            <a href="{{ post.postLink.shareLink }}">Share</a>
            <span aria-hidden="true">· </span>
            <a href="{{ post.postLink.viewLink }}">Full Story</a>
        </div>
    </div>
</div>
</div>
