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
                 style="background: url(<?= Utils::cached($vid) ?>) 
                            no-repeat 0px;
                            background-size: 120%"></div>

        </div>
    <?php endforeach; ?>
</div>
<?php endforeach; ?>

