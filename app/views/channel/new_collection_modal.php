<?php
use app\models\Collection;
if (!$collection->id) {
    $collection->name = Yii::$app->security->generateRandomString(10);
    if ($channel->id) {
        $collection->name = "{$channel->id}/{$collection->name}";
        $collection->channelId = $channel->id;
    }
}
?>

<!-- Modal -->
<div class="tr-modal modal fade" id="collectionModal" 
     tabindex="-1"  role="dialog" 
     aria-labelledby="collectionModal" 
     aria-hidden="true">

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                </button>

                <h4 class="modal-title" id="myModalLabel">
                    <span class="glyphicon glyphicon-unchecked"></span>
                    Create a collection
                </h4>
            </div>

            <div class="modal-body">
                <div role="tabpanel">

                  <!-- Nav tabs -->
                  <ul id="tabRef" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active">
                        <a href="#home" aria-controls="home" role="tab" data-toggle="tab">
                        Home
                        </a>
                    </li>
                    <li role="presentation">
                        <a href="#success" aria-controls="success" role="tab" data-toggle="tab">
                            Success
                        </a>
                    </li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="home">
                        <?php
                            echo \Yii::$app->view->renderFile(
                                "@app/views/collection/save.php",
                                ["model" => $collection,
                                "onSave" => 'function (obj){
                                    console.info(obj);
                                    console.info($("#tabRef a:last"));
                                    $("#tabRef a:last").click();
                                }']
                            );
                        ?>
                    </div>

                    <div role="tabpanel" class="tab-pane" id="success">
                        <div class="tr-alert alert alert-success">
                            Success.
                        </div>
                    </div>
                  </div>

                </div>
            </div>
        </div>
    </div>

</div>