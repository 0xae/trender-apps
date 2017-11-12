<div class="col-md-5">
<?php
    echo \Yii::$app->view->renderFile(
        "@app/views/plugins/stream/index.php",
        ["posts" => $posts,
         "cols" => $collections
        ]
    );
?>
</div>

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
