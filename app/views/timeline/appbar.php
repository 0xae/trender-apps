<?php
use app\models\DateUtils;
?>
<div class="tr-section">

    <h3>
        <a href="javascript:void(0)" id="">
            /t/<?= $timeline->name ?>
        </a>
    </h3>

    <p class="tr-description">
        <?= ($timeline->description=="") ? 'No description.' : $timeline->description; ?>
        <br/>
        <br/>
        <span class="fa fa-clock-o"></span>
        <time title="Creation Date">
            <?= DateUtils::formatToHuman($timeline->creationDateFmt) ?>
        </time>
        <br/>
        <span class="fa fa-search"></span>
        <strong>
            <?= ($timeline->topic == '*') ? 'everything' : $timeline->topic  ?>
        </strong>
    </p>

</div>

<div class="tr-section">
    <h3>
        <a href="javascript:void(0)" id="">
            timelines
        </a>
    </h3>
    
    <ul style="padding: 10px;padding-top: 3px;">
        <?php foreach ($timeline_list as $t): ?>
            <li>
                <a class="tr-link" href="index.php?r=timeline/index&id=<?= $t->id ?>">
                    <?= $t->name ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

