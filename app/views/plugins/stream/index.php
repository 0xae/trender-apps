<?php
if (!isset($cols)) {
	$cols = [];
}

foreach ($posts as $post) {
    $tpl = "@app/views/plugins/stream/generic_post.php";
    if ($post->type == "youtube-post") {
        $tpl = "@app/views/plugins/stream/youtube.php";
    }

    echo \Yii::$app->view->renderFile($tpl, [
        "post" => $post, 
        "cols" => $cols
    ]);
}

$script = <<<JS
requirejs(["trender/app", "jquery", "_", "t/zpost"], 
function (app, $, _, zpost){
	$(".tr-cache-it").each(function (){
		var self = this;
		var postId = $(this).attr("data-postid");
		var cached = $(this).attr("data-cached").trim();
		cached = cached.replace("[", "");
		cached = cached.replace("]", "");
		cached = cached.replace("\"", "");		

		if (!cached || cached=="none" || cached=="<uk>") {
			refetchImg();
		} else {
			var url=app.media() + "/media/" + cached;
			$.get(url)
			.then(function () {
				$(self).attr("src", url);
			}, function(){
				refetchImg();
			});
		}

		function refetchImg() {
			return zpost.downloadPic(postId)
			.then(function (data) {
				var url = app.media() + data;
				$(self).attr("src", data);
			}, function (error){
				// console.warn(error);
			});
		}
	});
});
JS;
$this->registerJs($script);
