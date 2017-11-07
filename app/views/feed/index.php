<?php
/* @var $this yii\web\View */
?>

<div class="row rs-row">
    <!--
	<div class="col-md-2">
	</div>
    -->

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

	<div class="col-md-4">
	</div>
</div>