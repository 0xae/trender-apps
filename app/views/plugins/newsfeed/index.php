<?php
use yii\helpers\Html;
use app\models\TabRender;
$collections = $channel->collections;
$tab = new TabRender("main");
$tab->_setViewPath("plugins/newsfeed");
$links = [];

$i=0;
foreach ($collections as $col) {
    $col->label = Html::encode($col->label);
    $label = ucfirst($col->label);
    $ret = $tab->fileLink($label, "collection", !$i++, [
        'posts' => $col->posts,
        'cols' => $collections,
        'group' => $col->groups,
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

<div class="col-md-12">
<?= $tab->render(); ?>
</div>
