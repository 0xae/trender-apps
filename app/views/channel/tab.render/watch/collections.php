<div class="col-md-5">
<?php foreach ($cols as $col): ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <span style="margin-right:7px;" class="glyphicon glyphicon-unchecked">
        </span>
        
        <strong>
            <?= $tab->ajaxLink($col->label, ["channel/view_collection", "id"=>$col->id]); ?>
        </strong>
    </div>
  
    <div class="panel-body">
        <?= $col->name ?> 
    </div>
</div>

<?php endforeach; ?>
</div>
