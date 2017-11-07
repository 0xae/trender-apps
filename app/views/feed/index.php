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

				<h3>
				<?= $channel_name ?>
				</h3>

        <div class="tr-section-content">
        <ul class="list-unstyled">
            <?php foreach ($trending as $trend): ?>
                <li>
                    <a href="./index.php?r=feed/index&q=<?= urlencode($trend['label']) ?>"
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
</div>
