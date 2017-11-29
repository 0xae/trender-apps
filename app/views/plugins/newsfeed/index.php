<?php
use yii\helpers\Html;
use app\models\TabRender;

$tab = new TabRender("main");
$tab->_setViewPath("plugins/newsfeed");
$links = [];
$collections = $feed['colls'];

$i=0;
foreach ($collections as $col) {
    $ret = $tab->fileLink($col->label, "collection", !$i++, [
        'col' => $col,
        'feed' => $feed,
        'channel' => $channel
    ]);

    if ($col->display) {
        $links[] = $ret;
    }
}

function render_post($post, $cols){
    $tpl = "@app/views/plugins/newsfeed/tab.render/main/generic_post.php";
    if ($post->type == "youtube-post") {
        $tpl = "@app/views/plugins/newsfeed/tab.render/main/youtube.php";
    }

    echo \Yii::$app->view->renderFile($tpl, [
        "post" => $post,
        "cols" => $cols
    ]);
}
?>

<div class="col-md-12 tr-channel-nav">
    <div role="tabpanel">
      <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
        <?php foreach ($links as $link): ?>
            <li role="presentation">
                <?= $link ?>
            </li>
        <?php endforeach; ?>
    </ul>
    </div>
</div>

<div class="col-md-12 rs-pad">
<?= $tab->render(); ?>
</div>
