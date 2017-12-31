<?php
use yii\helpers\Html;
use app\models\TabRender;

$tab = new TabRender("main");
$tab->_setViewPath("plugins/newsfeed");
$links = [];
$collections = $feed->colls;
$active_collection = $feed->active_collection;

foreach ($collections as $col) {
    $active = $col->id==$active_collection->id;
    if ($active) {
        $col->posts = $active_collection->posts;
    }

    $ret = $tab->fileLink($col->label, "collection", $active, [
        'col' => $col,
        'channel' => $channel,
        'feed' => $feed
    ]);

    if ($col->display) {
        $links[] = $ret;
    }
}

$HTML = <<<HTML
    <strong>My Collections</strong>
    <sup>
        <span class="glyphicon glyphicon-cog"></span>
    </sup>
HTML;

$links[] = $tab->fileLink($HTML, "my_collections", false, [
    'collections' => $collections
]);

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
            <li role="presentation" class="<?= strrpos($link, 'My Collections') > 0 ? 'pull-right tx-my-collections' : '' ?>">
                <?= $link ?>
            </li>
        <?php endforeach; ?>
    </ul>
    </div>
</div>

<div class="col-md-12 " style="background-color: #ddd;">
<?= $tab->render(); ?>
</div>
