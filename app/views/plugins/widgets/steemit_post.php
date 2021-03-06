<div class="media trender-post">
      <div class="media-left">
        <a href="#">
            <img class="media-object" src="<?= $post["picture"] ?>" alt="Foto of <?= $post["authorName"] ?>" width="70" height="50"/>
        </a>
      </div>

      <div class="media-body">
        <img src="static/img/steemit-196x196.png" style="display:inline;width:15px;height:15px;" /> 
        <h4 class="st-post-author" style="display: inline;">
            <?=  $post["authorName"]; ?>
            <span style="color: #999;">· </span>
            <a href="#" title="<?= $post['timestamp'] ?>" style="font-size:11px;padding: 0px;padding-right:3px;color:#777;text-decoration:none;font-weight:normal;">
                <?= $post["timestamp"] ?>
            </a>
        </h4>

        <p style="margin-bottom:5px;font-size:13px;">
            <?= $post["description"]; ?>
        </p>

        <ul class="nav nav-pills">
            <li role="presentation" class="">
                <a href="#" style="font-size:12px;padding: 0px;padding-right:3px;">
                    <img style="display:inline-block;padding:0px;" 
                         src="static/img/like.png" width="13" height="13" class="o">
                    0
                </a>
            </li>

            <li role="presentation" class="">
                <a target="__blank" href="<?= $post['link'] ?>" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">
                · <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">like</span>
                </a>
            </li>

            <li role="presentation" class="">
                <a target="__blank" href="<?= $post['link'] ?>" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">
                 · <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">comment</span>
                </a>
            </li>

            <li role="presentation" class="color: #777">
                <a target="__blank" href="<?= $post['link'] ?>" style="color:#777;font-size:12px;padding: 0px;padding-right:3px;">
                 ·  <span style="background-color: #eee;padding:1px;padding-left:3px;padding-right:3px;border-radius:3px;">full story</span>
                </a>
            </li>

            <!-- 
            <li role="" ng-click="openWebpage('<?= $post['source'] ?>')" class="">
                <a target="__blank" href="javascript:void(0)" 
                     style="margin-left:5px;color:#777;font-size:12px;padding: 0px;padding-right:3px;">
                     <span class="glyphicon glyphicon-fullscreen" style="font-size:10px;color: #0a7b0a;"></span>
                </a>
            </li>
            -->
        </ul>
      </div>
</div>
