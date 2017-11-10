<?php
foreach ($posts as $post) {
    $tpl = "@app/views/plugins/stream/generic_post.php";
    echo \Yii::$app->view->renderFile(
        $tpl, ["post" => $post]
    );   
}

$script = <<<JS
requirejs(["trender/app", "jquery", "_", "t/zpost"], 
function (app, $, _, zpost){
	$(".tr-cache-it").each(function (){
		var self = this;
		var postId = $(this).attr("data-postid");
		var nodeId = $(this).attr("id");
		zpost.downloadPic(postId)
		.then(function (data){
			var url = api.media() + data;
			console.info(url);
			$(self).attr("src", data);
		}, function (error){
			console.warn(error);
		});
	});
});
JS;

$this->registerJs($script);
?>
