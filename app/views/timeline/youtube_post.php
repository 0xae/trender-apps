<?php
use app\models\DateUtils;
$json = json_decode($post->data);
?>

<div role="article" class="dg di ds">
<div>
    <div>
        <div style="">
            <h3 class="dt dm" style="display: inline-block">
                <span>
                    <strong> 
                        <a href="javascript:void(0)">
                            <?= $post->authorName ?>
                        </a>
                    </strong>
                </span>
            </h3>
        </div>
    </div>
    <div class="du" style="">
        <span> <p> <?= $post->description ?> </p> </span>
    </div>

    <ul class="tr-menu normal-youtube-post">
        <li>
            <span class="fa fa-thumbs-up"></span>
            <?= $json->likes ?>
        </li>

        <li>
            <span class="fa fa-street-view"></span>
            <?= $json->views ?>
        </li>

        <li style="float: right">
            <span class="fa fa-clock-o"></span>
            <span style="font-size: 11px;">
            <strong>
                <?= DateUtils::formatToHuman($post->timestampFmt) ?>            
            </strong>
            </span>
        </li>
    </ul>
</div>
</div>
