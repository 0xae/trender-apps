<?php
$default = $tab->default;
if (!$tab->active) {
	$tab->active = $default;
}
?>

<!-- COMPONENT -->
<div class="tab-content tr-tab-content" id="<?= $tab->id ?>">
	<div role="tabpanel" class="tab-pane <?=($tab->active==$default)?'active':'' ?>" id="<?=$default?>">
	</div>

	<?php $i=0; foreach ($tab->comp as $obj): ?>
		<div role="tabpanel" class="tab-pane <?=($tab->active==$obj['id'])?'active':'' ?>" id="<?= $obj['id'] ?>">
		<?php 
			echo \Yii::$app->view->renderFile(
	            "@app/views/{$tab->viewPath()}/tab.render/{$tab->id}/{$obj['paneFile']}.php",
	            $obj["params"]
	        );
        ?>
		</div>
	<?php endforeach; ?>
</div>

<?php
$js=<<<JS
requirejs(["jquery", "bts"], function ($, bts){
	$(function(){
		$("a[data-target='#{$tab->active}']").click();		
	});
});
JS;

$this->registerJs($js);
