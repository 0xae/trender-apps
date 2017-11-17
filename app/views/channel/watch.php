<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\models\Post;
use app\models\Utils;
use app\models\Collection;
use app\models\TabRender;

$tab = new TabRender("watch");
if (!empty($posts))
    $picture = Utils::cached($posts[0]);
else
    $picture = '';

$collection = new Collection;
$this->title = 'Channel ' . $channel->name;

$collectionsLink = $tab->fileLink("Collections",  "collections", false, [
    'cols' => $collections
]);

$likesLink = $tab->fileLink("Likes", "likes", false, [
    'coll' => $like,
    'channel' => $channel
]);

$activityLink = $tab->fileLink("Activity", "activity", true, [
    "posts" => $posts,
    "videos" => $videos,
    "groups" => $groups,
    "channel" => $channel,
    'collections' => $collections
]);

$randomPost = false;
if (count($posts)) {
    $idx = rand(0, count($posts)-1);
    $randomPost = $posts[$idx];
    $picture = Utils::cached($randomPost);
}
?>

<div class="row rs-row">
    <div class="col-md-2" style="background-color: #fff;">
        <div class="row">
            <div class="col-md-12 rs-pad tr-channel-info">
                <div class="">
                    <span style="background-color: rgba(0,0,0,.6);padding:2px;position: absolute;min-height:40px;color:#fff;font-size:12px;width:100%;">
                        <?= $randomPost->description; ?> <br/>
                        <span>
                            <a href="<?= $randomPost->link ?>" 
                               class="txt-underline" 
                               style="color: #fff;">
                               <strong>full story</strong>
                            </a>
                        </span>
                    </span>
                    <img style="max-width: 100%;min-height:200px;" 
                         src="<?= $picture ?>" 
                         alt="..."
                    />
                </div>

                <a href="<?= Url::to(["channel/watch", "id"=>$channel->id]); ?>">
                    <h3 style="margin-top:5px;margin-left:5px;color: #666">
                        <?= $channel->name ?>
                    </h3>
                </a>

                <div class="tr-section">
                    <ul class="list-unstyled tr-settings" style="margin-bottom: 25px;">
                        <li role="presentation">
                            <a href="#">
                                <span class="fa fa-home"></span>
                            </a>
                            <?= $activityLink ?>
                        </li>
                        <li>
                            <span>
                                <a href="#">
                                    <span class="fa fa-thumbs-up"></span>
                                </a>
                                <?= $likesLink ?>
                            </span>
                        </li>

                        <li role="presentation">
                            <a href="#">
                                <span style="margin-right:7px;" class="glyphicon glyphicon-unchecked">
                                </span>
                            </a>

                            <span>
                                <?= $collectionsLink ?>
                            </span>
    
                            <a href="javascript:void(0)" class="pull-right">
                                <span class="label label-success"
                                      data-toggle="modal" data-target="#collectionModal">
                                      add
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- tr-section -->

                <div class="tr-section">
                    <h4 class="tr-section-title">
                        Other Channels
                    </h4>

                    <div class="tr-section-content">
                        <ul class="list-unstyled">
                            <?php foreach ($channels as $chan): ?>
                                <li>
                                    <a href="./index.php?r=channel/watch&id=<?=$chan->id?>"
                                       class="tr-more-item">
                                        <?= $chan->name ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>                
                </div>
                <!-- tr-section -->
            </div>
        </div>
    </div>

    <div class="col-md-10 tr-channel-content">
        <div class="rs-row row" style="padding:0px;">
            <?= $tab->render(); ?>
        </div>
    </div>
</div>

<?php
    echo \Yii::$app->view->renderFile(
        "@app/views/channel/new_collection_modal.php", [
            "collection" => $collection,
            "channel" => $channel
        ]
    );
?>
