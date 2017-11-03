<?php
use app\models\Utils;

$imgs = [];
$k = 0;
$MAX=22;
$videosCount = count($videos);

if (!isset($blockCount)){
    $blockCount = 6;
}

if (!isset($perBlock)){
    $perBlock = 2;
}

for ($i=0; $i<$blockCount; $i++){
    if ($i >= $videosCount) {
        break;
    }

    $data = [];
    for ($j=0; $j<$perBlock; $j++) {
        // XXX: remove this later
        do {
            $vid = @$videos[$k++];
            if (!$vid) break;
        } while (!@$vid->cached);
        if ($vid)
            $data[] = $vid;
    }

    $imgs[] = $data;
}
?>


<?php foreach ($imgs as $img): ?>
<div class="tr-img-container">
    <?php foreach ($img as $vid): ?>
        <div class="" title="<?= $vid->description ?>">
            <span class="tr-img-descr">
                <small>
                <!--
                <img src="static/img/youtube-small.ico" 
                     width="15px" 
                 />
                 
                 -->

                <?php 
                    echo (strlen($vid->description) >= $MAX) ? 
                        substr($vid->description, 0, $MAX) . '...' : 
                        $vid->description;
                ?>
                </small>
            </span>

            <div class="tr-img-instance" 
                 data-bimg="url(<?= Utils::cached($vid) ?>)"></div>

        </div>
    <?php endforeach; ?>
</div>
<?php endforeach; ?>

<?php
$scrip = <<<JS
requirejs(['trender/app', '_', 'jquery'],
function (app, _, $) {

function algo1() {
    var i = 100;

    $(".tr-img-instance").each(function (node){
        var speed = _.random(1, 1989899);
        var step = 100;
        var url = $(this).attr("data-bimg");
        var style ='background: '+url+
                        'no-repeat 0px;'+
                        'background-size: 120%;opacity:.7;';
        var self = this;
		setTimeout(function(){
			$(self).attr("style", style);
            $(self).css("opacity", ".8");
            $(self).css("opacity", ".9");
            $(self).css("opacity", "1");
            setTimeout(function (){
                $(self).css("opacity", ".7");				
			}, (step+i/_.random(1,5))/speed);
            i+=i;
		}, 100+i);
    });
}

function algo0de(){
    var i = 100;    
    $(".tr-img-instance").each(function (node){
        var url = $(this).attr("data-bimg");
        var style ='background: '+url+
                        'no-repeat 0px;'+
                        'background-size: 120%';
        var self = this;
		setTimeout(function(){
			$(self).attr("style", style);
		}, _.random(1, 99) + 100);
    });
}

algo0de();
});
JS;

$this->registerJs($scrip);


