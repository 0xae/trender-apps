<?php
$images = $post["json"]["images"];
$hasImages = !empty($images);
?>

<div class="media">
    <div class="media-left">
        <a href="#">
            <img style="" class="media-object" 
                 src="<?= $post["picture"]; ?>"
                 alt="Foto of <?= $post["authorName"]; ?>" 
                 width="70" height="50"
            />
        </a>
    </div>

    <div class="media-body">
        <h4 class="st-post-author ng-binding" style="display: inherit;">
             <img src="static/img/twitter-192x192.png" style="display:inline;width:18px;height:18px;">
             <?= $post["json"]["username"]; ?>           
             <span style="color: #999;">· </span>
             <a href="#" title="" style="font-size:11px;padding: 0px;padding-right:3px;color:#777;text-decoration:none;font-weight:normal;" class="ng-binding">
                 <?= $post["timestamp"]; ?>
             </a>
        </h4>

        <p style="margin-bottom:0px;font-size:13px;padding:4px;padding-bottom:2px;">
            <?= $post["description"]; ?>
        </p>

        <div>
            <?php if ($hasImages): ?>
                <div class="col-md-12">
                    <a href="#" class="" style="border:0px;padding:0px;">
                        <img style="border-radius:4px;height:200px;width:300px;" 
                             src="<?= $images[0]; ?>" 
                             alt="..." 
                        />
                    </a>
                </div>
            <?php endif; ?>
            <ul class="nav nav-pills">
                <li role="presentation" class="">
                    <a href="#" style="font-size:12px;padding-right:2px;" class="ng-binding">
                        <span style="margin-right:5px;" class="glyphicon glyphicon-comment"></span>
                        <strong>
                            <?= $post["json"]["replies"] ?>
                        </strong>
                    </a>
                </li>

                <li role="presentation" class="">
                    <a href="#" style="font-size:12px;padding-right:2px;" class="ng-binding">
                        <span style="margin-right:5px;" class="glyphicon glyphicon-retweet"></span>
                        <strong>
                            <?= $post["json"]["retweets"] ?>
                        </strong>
                    </a>
                </li>

                <li role="presentation" class="">
                    <a href="#" style="font-size:12px;padding-right:2px;" class="ng-binding">
                        <span style="margin-right:5px;" class="glyphicon glyphicon-heart-empty"></span>
                        <strong> <?= $post["json"]["love"] ?> </strong>
                    </a>
                </li>

                <li role="presentation" class="color: #000;margin-left:0px;padding-left:0px;">
                    <strong>
                        <a href="<?= $post["link"]; ?>" target="__blank" 
                           style="padding-left:0px;font-size:12px;">
                        </a>
                    </strong>
                </li>
            </ul>
        </div>
    </div>
</div>
