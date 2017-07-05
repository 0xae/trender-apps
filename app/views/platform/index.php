<?php
$this->title = 'Trender Platform';
?>
 
<div class="row">
    <div class="col-md-2" style="padding:10px;padding-top: 50px;padding-left: 20px;height:100%;position:absolute; box-shadow: -1px 0 0 #392e5c inset;background-color: #2c2541;">
        <?php echo $this->render("helpers/sidebar"); ?>
    </div>

    <div class="col-md-8" style="margin-left:250px;margin-top: 50px;">
        <?php echo $this->render("plugins/steemit_feed"); ?>
    </div>
 </div>

