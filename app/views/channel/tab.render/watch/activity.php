<div class="col-md-12 tr-channel-nav">
    <div role="tabpanel">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
            <a href="#profile" aria-controls="profile" 
                role="tab" data-toggle="tab">
                News
            </a>
        </li>
        <li role="presentation">
            <a href="#profile" aria-controls="profile" 
                role="tab" data-toggle="tab">
                Places
            </a>
        </li>
        <li role="presentation">
            <a href="#profile" aria-controls="profile" 
                role="tab" data-toggle="tab">
                Events
            </a>
        </li>
        <li role="presentation">
            <a href="#profile" aria-controls="profile" 
                role="tab" data-toggle="tab">
                Videos
            </a>
        </li>
        <li role="presentation">
            <a href="#profile" aria-controls="profile" 
                role="tab" data-toggle="tab">
                Favorites
            </a>
        </li>
      </ul>
    </div>
</div>

<div class="col-md-5">
<?php
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/stream/index.php", [
            "posts" => $posts,
            "cols" => $collections
        ]
    );
?>
</div>

<div class="col-md-5">
<?php
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/stream/index.php", [
            "posts" => $videos
        ]
    );
?>
</div>

<!--
<div class="col-md-2 pull-right rs-pad">
    <div class="tr-section">
        <h4 class="tr-section-title">
            Conversations
        </h4>

        <div class="tr-section-content">
        <ul class="list-unstyled">
            <?php foreach ($groups as $group): ?>
                <li>
                    <a href="./index.php?r=channel/watch&id=<?=$channel->id?>&fq=category:<?=urlencode($group['label']) ?>"
                       class="tr-more-item">
                        <?= $group["label"] ?>
                        (<?= $group['score'] ?>)
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        </div>
    </div>
</div>
-->