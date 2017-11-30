<?php
use yii\widgets\ActiveForm;
use app\models\Post;
use app\models\Utils;

if (!empty($posts))
	$picture = Utils::cached($posts[0]);
else
	$picture = '';
?>

<div class="row rs-row" style="padding-top:60px;">
	<div class="col-md-2" style="background-color: #fff;">
		<div class="row">
			<div class="col-md-12 rs-pad">
				<h3 style="margin-top:5px;margin-left:5px;">
				<?= $channel_name ?>
				</h3>

			    <div class="tr-section">
			        <ul class="list-unstyled tr-settings" style="margin-bottom: 25px;">
			            <li>
			                <a href="#">
			                    <span class="fa fa-random"></span>Channels
			                    <strong>(+200)</strong>
			                </a>
			            </li>

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
			                    <strong>(10)</strong>
			                </a>
			            </li>
			        </ul>
			    </div>

			    <div class="tr-section">
			        <h4 class="tr-section-title">
			            Channels
			            <!--
			                <span class="glyphicon glyphicon-flash">
			                </span>
			            -->
			        </h4>

			        <div class="tr-section-content">
			        <ul class="list-unstyled">
			            <?php foreach ($trending as $trend): ?>
			                <li>
			                    <a href="./index.php?r=channel/watch&name=<?=$trend["label"]?>&q=<?= $q . '&fq=category:' . urlencode($trend['label']) ?>"
			                       class="tr-more-item">
			                        <?= $trend["label"] ?>
			                        (<?= $trend['score'] ?>)
			                    </a>
			                </li>
			            <?php endforeach; ?>
			        </ul>
			        </div>
			    
			    </div>
			</div>
		</div>
	</div>

	<div class="col-md-5" id="posts_container">
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
</div>
