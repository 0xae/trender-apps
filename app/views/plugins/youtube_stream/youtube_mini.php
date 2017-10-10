<?php
use app\models\DateUtils;
$json = json_decode($post->data);
$ary = [
    '22d66e8c741c3573d9bcdb3176d5ec3b.jpg',
    'c72b679283d5fdf4e198fe18b5461437.jpg',
    'e33bfe546673f7f4151003b17b162b48.jpg',
    '30fe705c1b9e5e43ebe5c56e5b02b1e4.jpg',
    '2b8d78185b85ae21610b14dc25f88ce8.jpg',
    '8df4fbeaf573ddd4458d3977a03dcbce.jpg'
];
?>

<div role="article" class="dg di ds youtube-post youtube-mini-post" 
     id="tr-post-<?= $post->id ?>" 
     v-on:click="log('<?= $post->id ?>')">
<div>
    <div>
        <div class="tr-img-loader by bz ca" 
             style="width:146px;float:left;margin-right: 5px;">

        <div style="width:146px;height:78px;border-radius:3px;"
             id="yt-img-<?= $post->id ?>"
             
             >

            <div class="tr-shadow" style="height:10px">
                <center>
                    <div class="" 
                         style="padding-top:20px;color:red;font-size: 25px;">
                        <span class="fa fa-play" title="Play"></span>
                    </div>
                </center>

                <div style="color: #fff;margin-top:11px;background-color: rgba(0,0,0,.7);">
                    <span style="margin-left:5px;">
                    </span>
                    <span style="float: right;margin-right:5px;">
                        <strong>
                            <span class="fa fa-clock-o" style="font-size:12px"></span>
                            00:00
                        </strong>
                    </span>
                </div>
            </div>    
        </div>        

        </div>

        <div style="">
            <h3 class="dt dm" style="display: inline-block">
                <span>
                    <strong> 
                        <a href="javascript:void(0)">
                            <?= $post->authorName ?>
                        </a>
                    </strong>
                </span>
                <br/>
                <div style="color: gray">
                    <span style="font-size:10px" class="fa fa-clock-o"></span>
                    <span style="font-size: 11px;">
                        <strong>
                            <?= 
                                DateUtils::youtubeFmt($post->timestampFmt) 
                            ?>   
                        </strong>
                    </span>
                </div>
            </h3>
        </div>

    </div>
    
    <div class="du" style="padding-left: 40px;">
        <span> <p> <?= $post->description ?> </p> </span>
    </div>
</div>
</div>
