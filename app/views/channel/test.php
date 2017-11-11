<?php
use app\models\TabRender;
$tab = new TabRender("test");
$media = $tab->fileLink("Media Pane", "media");
?>

<div class="col-md-2">
  <ul class="list-unstyled">
    <li role="presentation" class="active">
      <?= $tab->ajaxLink("Channel Index", ["channel/index", "id"=>12], true); ?>
    </li>

    <li role="presentation">
      <?= $tab->fileLink("Activity Pane", "activity"); ?>
    </li>
    
    <li role="presentation">
      <?= $media ?>
    </li>
  </ul>

</div>

<div class="col-md-6">
  <?= $media ?>

  <?= $tab->render(); ?>
</div>
