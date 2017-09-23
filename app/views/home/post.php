<div role="article" class="dg di ds">
<div>
    <div>
        <div class="by bz ca" style="width:50px;float: left; margin-right: 5px;">
            <a class="cb" 
               href="<?= $post["link"]; ?>" 
               style="width:50px; height: 50px;"
               title="Profile picture of <?= $post["authorName"] ?>">
                <img src="<?= $post['picture'] ?>" 
                     width="50" 
                     height="50" 
                     class="" 
                     alt="Post Picture">
            </a>
        </div>
        <div style="">
            <h3 class="dt dm" style="display: inline-block">
                <span>
                    <strong> 
                        <a href="javascript:void(0)">
                            <?= $post["authorName"] ?>
                        </a>
                    </strong>
                </span>
            </h3>
        </div>
    </div>
    <div class="du" style="">
        <span> <p> <?= $post['description'] ?> </p> </span>
    </div>

    <div class="el">
        <div class="k cv"> <abbr><?= $post["timestamp"] ?></abbr> </div>
        <div class="k cv">
            <a class="" aria-label="" href="<?= $post["link"]; ?>">
                <img style="display:inline-block;padding:0px;" src="https://z-m-static.xx.fbcdn.net/rsrc.php/v3/yC/r/9RmeZ1lDDHz.png" width="13" height="13" class="o">
                {{ post.postReaction.countLikes }} 
            </a>
            <span aria-hidden="true">· </span>
            <a href="<?= $post["link"]; ?>">Like</a>
            <span aria-hidden="true">· </span>
            <a href="<?= $post["link"]; ?>">Full Story</a>
        </div>
    </div>
</div>
</div>
