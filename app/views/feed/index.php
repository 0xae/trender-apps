<?php
use yii\widgets\ActiveForm;
use app\models\Post;
use app\models\Utils;
use app\models\Channel;
use app\models\Collection;
use yii\helpers\Url;

if (!empty($posts))
	$picture = Utils::cached($posts[0]);
else
	$picture = '';

$top_keywords = $trending;
$the_date = date("M d, Y"); // today for now
$top = $sugestions['top_channels'];
$recent = $sugestions['recent_channels'];
$posts = [];

// foreach ($top as $chan) {
// 	foreach ($chan->collections[0]->posts as $p) 
// 		$posts[] = $p;
// }

foreach ($recent as $chan2) {
	foreach ($chan2->collections[0]->posts as $p) 
		$posts[] = $p;
}

shuffle($posts);
?>

<div class="row rs-row" style="padding: 0px;background-color:#000">
	<div class="col-md-12" id="tr-slideshow-container">			
		<div class="tx-welcome" style="">
			<h1>Welcome to Trender</h1>
			<form role="form" class="form-horizontal">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search for anything...">
						<span class="input-group-btn">
							<button class="btn btn-warning" type="button">
								<strong>Go</strong>
							</button>
						</span>
					</div><!-- /input-group -->
			</form>
		</div>

		<?php
			echo \Yii::$app->view->renderFile (
				"@app/views/plugins/posts_slideshow/index.php",
				["posts" => $posts, "blockCount" => 16, "perBlock"=>1]
			);
		?>
	</div>

	<div class="col-md-4">
	</div>
</div>

<!-- channels inteligence preview -->
<div class="row rs-row">
	<div class="col-md-12 tx-update">
	</div>
		
	<div class="col-md-12">
		<div class="tr-section">
			<h4 class="tr-section-title" style="margin:0px;">
				Top channels
			</h4>

			<span class="tr-section-date">
				<span class="glyphicon glyphicon-calendar"></span>
				<?= $the_date ?>
			</span>

			<div class="row" style="margin-top:5px">
				<?php
					echo \Yii::$app->view->renderFile(
						"@app/views/plugins/channel_listing/index.php", [
							"channels" => $top
						]
					);
				?>
			</div>
		</div>
		<div class="tr-section">
			<h4 class="tr-section-title" style="margin:0px;">
				Recent
			</h4>
			<span class="tr-section-date">
				<span class="glyphicon glyphicon-calendar"></span>
				<?= $the_date ?>
			</span>
			<div class="row" style="margin-top:5px">
				<?php
					echo \Yii::$app->view->renderFile(
						"@app/views/plugins/channel_listing/index.php", [
							"channels" => $recent,
						]
					);
				?>
			</div>
		</div>	
	</div>
</div>

<!-- top keywords -->
<div class="row rs-row" style="padding-top:60px;">
	<div class="col-md-2"></div>
	<div class="col-md-7 rs-pad">
		<div class="tr-section">
			<h4 class="tr-section-title" style="margin:0px;">
				Top keywords
			</h4>
			<span class="tr-section-date">
				<span class="glyphicon glyphicon-calendar"></span>
				<?= $the_date ?>
			</span>

			<div class="tr-section-content">
				<?php foreach ($top_keywords as $tk): ?>
					<span class="tx-keyword">
						<a href="./index.php?r=channel/watch&name=<?=$tk["label"]?>&q=*<?= '&fq=category:' . urlencode($tk['label']) ?>"
							class="tr-more-item">
							<?= $tk["label"] ?>
							(<?= $tk['score'] ?>)
						</a>
					</span>
				<?php endforeach; ?>
			</div>			    
		</div>
	</div>
</div>
