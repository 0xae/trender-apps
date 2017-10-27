<?php
$this->title = 'Trender Home';
$imgs = [];
$perBlock = 2;
$k = 0;
$MAX=22;
for ($i=0; $i<6; $i++){
    $data = [];
    for ($j=0; $j<$perBlock; $j++){
        // XXX: remove this later
        do {
            $vid = $videos[$k++];
        } while(!@$vid['cached']);
        $data[] = $vid;
    }
    
    $imgs[] = $data;
}
?>

<style>
.tr-header {
    background-color: #000;
    min-height: 300px;
    padding: 5px;
}

.tr-img-container {
    display: block;
    max-height: 138px;
    max-width: 195px;
}

.tr-img-container img.tr-cover {
    width: 183px;
    height: 129px;
    margin-bottom: 10px;
}

.tr-img-container small {
    font-size: 12px;
    color: #fff;
    font-weight: bold;
}

.tr-img-display {
}
</style>

<div class="container tr-container">
<div class="row">
    <div class="col-md-12 tr-header">
        <?php foreach ($imgs as $img): ?>
            <div class="col-md-2 tr-img-display">
            <?php foreach ($img as $vid): ?>

                <div class="tr-img-container">
                    <small>
                    <img src="static/img/youtube-small.ico" width="15px" />

                     <?php 
                        echo (strlen($vid['description']) >= $MAX) ? 
                            substr($vid['description'], 0, $MAX) . '...' : 
                            $vid['description'];
                     ?>
                    </small>
                    <img class="tr-cover" src="../<?= $vid['cached'] ?>" />
                </div>
            <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="col-md-2">
        <h1>div1</h1>
    </div>

    <div class="col-md-8">
        <h1>div2</h1>
    </div>

    <div class="col-md-2">
        <h1>div3</h1>
    </div>
</div>
</div>

