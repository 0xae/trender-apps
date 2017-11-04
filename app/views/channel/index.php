<style type="text/css">
.tr-channel-panel {
	margin: 0px;
	padding: 0px;
	text-align: center;
	padding-top: 30px;
	padding-bottom: 30px;
	background-color: #fff;

    border-left: 1px solid #cecece;
    border-bottom: 1px solid #cecece;
}
.tr-channel-name {
	font-weight: bold;
	font-size: 13px;
}
</style>

<?php
$count = count($channel);
$left = 48 - $count;
?>

<div class="row rs-row tr-header-panel">
<div class="col-md-12 tr-header-inner">
    <h1>
        <center>
        <span class="glyphicon glyphicon-random"></span>
        Channels
        </center>
    </h1>
</div>
</div>


<div class="row rs-row" style="height: 400px;">

<div class="col-md-2">
	<h4>My Channels</h4>
	<p>Discover, create and explore channels.</p>
    <ul class="list-unstyled">
        <li>
            <a href="#" class="tr-txt-underline tr-txt-13">
                <strong>Create channel</strong> 
                <span class="glyphicon glyphicon-share-alt"></span> 
            </a>
        </li>
        <li>
            <a href="#" class="tr-txt-underline tr-txt-13">
                <strong>Recent</strong> 
                <span class="glyphicon glyphicon-share-alt"></span> 
            </a>
        </li>
        <li>
            <a href="#" class="tr-txt-underline tr-txt-13">
                <strong>Activity</strong> 
                <span class="glyphicon glyphicon-share-alt"></span> 
            </a>
        </li>
        <li>
            <a href="#" class="tr-txt-underline tr-txt-13">
                <strong>Statistics</strong> 
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

</div>

<div class="col-md-10" style="padding: 0px;">
	<?php foreach ($channel as $c): ?>
		<div class="col-md-2" style="margin:0px;padding:0px;" title="Channel <?= $c->name ?>">
			<div class="tr-channel-panel tr-link" style="height:100px">
				<span class="tr-channel-name"><?= $c->name ?></span> <br/>
				<span style="font-size: 12px;">
					<a style="text-decoration:underline;" href="./index.php?r=channel/view&id=<?= $c->id ?>">View</a>
					<a style="text-decoration:underline;" href="./index.php?r=channel/update&id=<?= $c->id ?>">Edit</a>
				</span>
			</div>
		</div>
	<?php endforeach; ?>

	<?php for ($i=0; $i < $left; $i++): ?>
		<div class="col-md-2" style="margin:0px;padding:0px;">
			<div class="tr-channel-panel tr-link" style="height:100px">
				<span class="glyphicon glyphicon-picture"></span>
			</div>
		</div>
	<?php endfor; ?>
</div>
</div>

