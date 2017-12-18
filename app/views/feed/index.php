<?php
use yii\widgets\ActiveForm;
use app\models\Post;
use app\models\Utils;
use yii\helpers\Url;

if (!empty($posts))
	$picture = Utils::cached($posts[0]);
else
	$picture = '';

$top_keywords = $trending;
$the_date = date("M d, Y"); // today for now
$top = $sugestions['top_channels'];
$recent = $sugestions['recent_channels'];
?>

<!-- channels inteligence preview -->
<div class="row rs-row">
	<div class="col-md-12">
		<div class="tr-section">
			<h4 class="tr-section-title" style="margin:0px;">
				Top channels
			</h4>
			<span class="tr-section-date">
				<span class="glyphicon glyphicon-calendar"></span>
				<?= $the_date ?>
			</span>

			<div class="row">
            <?php
                echo \Yii::$app->view->renderFile(
                    "@app/views/plugins/channel_listing/index.php", [
                        "channels" => $top,
                    ]
                );
            ?>
			</div>
		</div>
	</div>

	<div class="col-md-12">
		<div class="tr-section">
			<h4 class="tr-section-title" style="margin:0px;">
				Recent channels
			</h4>
			<span class="tr-section-date">
				<span class="glyphicon glyphicon-calendar"></span>
				<?= $the_date ?>
			</span>
			<div class="row">
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

