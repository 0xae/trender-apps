<?php
use yii\widgets\ActiveForm;
use app\models\Post;
use app\models\Utils;

if (!empty($posts))
	$picture = Utils::cached($posts[0]);
else
	$picture = '';
?>

<div class="row rs-row">
	<div class="col-md-2" style="background-color: #fff;">
		<div class="row">
			<div class="col-md-12 rs-pad">
				<img style="max-width: 100%;" 
					src="<?= $picture ?>" 
					 alt="..." />

				<h3 style="margin-top:5px;margin-left:5px;">
				#<?= $channel->id?> <?= $channel->name ?>
				</h3>

			    <div class="tr-section">
			        <ul class="list-unstyled tr-settings" style="margin-bottom: 25px;">
			            <li>
			                <a href="#">
			                    <span class="fa fa-thumbs-up"></span>Likes 
			                    &nbsp;<strong>(0)</strong>
			                </a>
			            </li>

			            <li>
			                <a href="#">
			                    <span class="fa fa-star"></span>Favorites
			                    <strong>(0)</strong>
			                </a>
			            </li>

			            <li>
			                <a href="#">
			                    <span style="margin-right:7px;" class="glyphicon glyphicon-unchecked"></span>
			                    Collections
			                    <strong>(0)</strong>
			                </a>
			            </li>
			        </ul>
			    </div>

			    <div class="tr-section">
			        <h4 class="tr-section-title">
			            Other Channels
			            <!--
			                <span class="glyphicon glyphicon-flash">
			                </span>
			            -->
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
			</div>
		</div>
	</div>

	<div class="col-md-10 tr-chan-menu">
		<ul class="nav nav-pills">
			<li role="presentation" class="active">
				<a href="#">Activity</a>
			</li>
			<li role="presentation">
				<a href="#">News</a>
			</li>
			<li role="presentation">
				<a href="#">Media</a>
			</li>
			<li role="presentation">
				<a href="#">Events</a>
			</li>
			<li role="presentation">
				<a href="#">Places</a>
			</li>
			<li role="presentation" class="pull-right">
				<a href="#">
					<span class="badge badge-default">add</span>
				</a>
			</li>
		</ul>
	</div>

	<div class="col-md-6" id="posts_container">
	   <div id="posts_container_stream_start">
	    </div>

	    <div class="rs-row row" id="posts_container_stream">
	        <?php
	            echo \Yii::$app->view->renderFile(
	                "@app/views/plugins/stream/index.php",
	                ["posts" => $posts]
	            );
	        ?>
	    </div>
	</div>

	<div class="col-md-2 pull-right rs-pad" style="background-color: lightgray;">
	    <div class="tr-section">
	        <h4 class="tr-section-title">
	            Collections
	            <!--
	                <span class="glyphicon glyphicon-flash">
	                </span>
	            -->
	        </h4>

	        <div class="tr-section-content">
	        <ul class="list-unstyled">
	            <?php foreach ($collections as $col): ?>
	                <li>
	                    <a href="./index.php?r=channel/watch&id=<?=$channel->id?>&fq=category:<?=urlencode($col['label']) ?>"
	                       class="tr-more-item">
	                        <?= $col["label"] ?>
	                        (<?= $col['score'] ?>)
	                    </a>
	                </li>
	            <?php endforeach; ?>
	        </ul>
	        </div>
	    
	    </div>
	</div>
</div>
