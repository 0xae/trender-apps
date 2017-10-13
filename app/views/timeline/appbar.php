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

<div class="tr-section" id="timelineForm" v-if="showForm">
    <h3>
        <a href="javascript:void(0)" id="">
            create timeline
        </a>
    </h3>

    <div style="padding: 5px;">
        <form action="GET">
            <input type="text"
                   class="v1-input" 
                   v-model="topic"
                   placeholder="topic" />

            <input type="text"
                   class="v1-input" 
                   style="margin-top: 4px"
                   v-model="name"
                   placeholder="name (optional)" />

            <button type="button"
                    v-on:click="submit({topic: topic, name: name})"
                    class="v1-btn">
                    save
            </button>
        </form>
    </div>
</div>

<div class="tr-section">
    <a href="javascript:void(0)" 
       style="float: right;" 
       v-on:click="showTForm"
       v-if="!showForm"
       class="v1-btn">
        create
        <span class="tr-btn-log fa fa-plus"></span>
    </a>

    <a href="javascript:void(0)" 
       style="float: right;" 
       v-on:click="hideTForm"
       v-if="showForm"
       class="v1-btn">
        cancel
        <span class="tr-btn-log fa fa-times"></span>
    </a>

    <a href="javascript:void(0)" style="margin-bottom: 13px" id="">
        <h3>timelines</h3>
    </a>

    <ul style="padding: 10px;margin-top: .5px;">
        <li v-for="(item,index) in listing" :id="'tl-' + item.id">
            <a class="tr-link" :href="'index.php?r=timeline/index&id='+item.id">
                {{item.name}}
            </a>

            <a class="tr-link-opts"  href="javascript:void(0)"
               v-on:click="deleteTimeline(item.id)">
                delete
            </a>
        </li>

        <?php foreach ($timeline_list as $t): ?>
            <li id="tl-<?= $t->id ?>">
                <a class="tr-link" 
                   href="index.php?r=timeline/index&id=<?= $t->id ?>">
                    <?= $t->name ?></a>
 
                <a class="tr-link-opts"  href="javascript:void(0)"
                    v-on:click="deleteTimeline(<?= $t->id ?>)">
                    delete
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

</div>

