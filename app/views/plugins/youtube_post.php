<div class="media">
    <div class="media-left">
        <a href="#">
            <img style="border-radius:88px" class="media-object" 
                src="<?= $post["picture"] ?>" 
                alt="Foto of <?= $post["authorName"] ?>" 
                width="50" 
                height="50" 
            />
        </a>
    </div>

    <div class="media-body">
        <img src="static/img/youtube-medium.png" style="display:inline;width:15px;height:15px;">
        <h4 class="st-post-author ng-binding" style="display: inline;">
            <?= $post["authorName"] ?>
            <a href="#" title="" style="font-size:11px;padding: 0px;padding-right:3px;color:#777;text-decoration:none;font-weight:normal;" class="ng-binding">
               · <?= $post["timestamp"]; ?>
            </a>
        </h4>

        <p style="margin-bottom:5px;font-size:13px;padding:4px;" class="">
            <?= $post["description"]; ?>
        </p>

        <div class="row">
            <div class="col-md-12">
                <iframe style="border:0px;border-radius:4px" type="text/html" 
                        width="300" height="200" 
                        src="https://www.youtube.com/embed/<?= $post["json"]["video_id"]; ?>&amp;source=example.com&amp;autoplay=0">
                </iframe>
            </div>
        </div>

        <ul class="nav nav-pills">
            <li role="presentation" class="">
                <a href="#" style="font-size:12px;padding: 4px;padding-right:3px;" class="ng-binding">
                    <img style="display:inline-block;padding:0px;" 
                         src="static/img/like.png" 
                         width="13" height="13" 
                         class="" />
                </a>
            </li>
            <li role="presentation" class="color: #777">
            <a target="__blank" href="<?= $post["link"]; ?>" style="color:#777;font-size:12px;padding: 4px;padding-right:3px;">
                    ·  
                    <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
