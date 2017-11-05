<?php if (isset($menuConf)): ?>
<h4><?= $menuConf['label'] ?></h4>
<p><?= @$menuConf['descr'] ?></p>
<?php endif; ?>

<ul class="list-unstyled">
    <li>
        <a href="index.php?r=channel/timeline" class="tr-txt-underline tr-txt-13">
            <strong>Timeline</strong> 
            <span class="glyphicon glyphicon-share-alt"></span> 
        </a>
    </li>
    <li>
        <a href="index.php?r=channel/recent" class="tr-txt-underline tr-txt-13">
            <strong>Recent</strong> 
            <span class="glyphicon glyphicon-share-alt"></span> 
        </a>
    </li>
    <li>
        <a href="index.php?r=channel/activity" class="tr-txt-underline tr-txt-13">
            <strong>Activity</strong> 
            <span class="glyphicon glyphicon-share-alt"></span> 
        </a>
    </li>
    <li>
        <a href="index.php?r=channel/statistics" class="tr-txt-underline tr-txt-13">
            <strong>Statistics</strong> 
            <span class="glyphicon glyphicon-share-alt"></span> 
        </a>
    </li>
    <li>
        <a href="index.php?r=channel/new" class="tr-txt-underline tr-txt-13">
            <strong>Create channel</strong> 
            <span class="glyphicon glyphicon-share-alt"></span> 
        </a>
    </li>
    <!--
    <li>
        <a href="index.php?r=channel/new" class="tr-txt-underline tr-txt-13">
            <strong>Create channel</strong> 
            <span class="glyphicon glyphicon-share-alt"></span> 
        </a>
    </li>
-->
    <li>
        <a href="index.php?r=channel/public" class="tr-txt-underline tr-txt-13">
            <strong>Public channels</strong> 
            <span class="glyphicon glyphicon-share-alt"></span> 
        </a>
    </li>
    <li>
        <a href="index.php?r=channel/private" class="tr-txt-underline tr-txt-13">
            <strong>Private channels</strong> 
            <span class="glyphicon glyphicon-share-alt"></span> 
        </a>
    </li>
</ul>
<br/>

<h4>Filter by</h4>
<ul class="list-unstyled">
    <li><a href="#"><strong>Most Recent</strong></a></li>
    <li><a href="#"><strong>Most Popular</strong></a></li>
    <li><a href="#"><strong>Most Active</strong></a></li>
    <li><a href="#"><strong>Hot right now</strong></a></li>
</ul>
<br/>

<h4>Order by</h4>
<ul class="list-unstyled">
    <li><a href="#"><strong>Relevance</strong></a></li>
    <li><a href="#"><strong>Time</strong></a></li>
    <li><a href="#"><strong>Curation</strong></a></li>
    <li><a href="#"><strong>Activity</strong></a></li>
    <li><a href="#"><strong>Size</strong></a></li>
</ul>


