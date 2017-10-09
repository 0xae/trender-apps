<?php
use app\models\DateUtils;
$json = json_decode($post->data);
$pic = "https://img.youtube.com/vi/{$json->video_id}/0.jpg";
?>

<div role="article" class="dg di ds">
<div>
    <div id="tr-outdoor-img" style="width:100%;height:200px;margin-bottom: 10px;"
         v-tx-img-cache="{post: post, link: link, done: done}"
    >
        <div class="tr-shadow">
        <center>
        <!--<img width="350px" src="https://img.youtube.com/vi/<?= $json->video_id ?>/0.jpg" />-->
            <div class="tr-main-badge" style="margin-top: 100px;">
             <span class="fa fa-play"></span> Play video
            </div>
        </center>    
        </div>    
    </div>
    <div style="padding: 10px;padding-top:2px;">
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
        <div class="du" style="">
            <span> <p> <?= $post->description ?> </p> </span>
        </div>

        <ul class="tr-menu featured-youtube-post">
            <li>
                <span class="fa fa-thumbs-up"></span>
                <?= $json->likes ?>
            </li>

            <li>
                <span class="fa fa-street-view"></span>
                <?= $json->views ?>
            </li>

            <li>
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
</div>

<?php
$json = json_encode($post);
$scrip = <<<JS

new Vue({
    el: "#tr-outdoor-img", 
    data:{
        post: $json,
        link: '$pic',
        done: function (node, src) {
            var tpl = 'url('+src+') 10px -57px'
            node.elm.style['background'] = tpl;
        }
    }
});

JS;

$this->registerJs($scrip);
