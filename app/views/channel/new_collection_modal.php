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
                <?php
                    echo \Yii::$app->view->renderFile(
                        "@app/views/collection/save.php",
                        ["model" => $collection]
                    );
                ?>
            </div>
        </div>
    </div>

</div>

<?php
$scrip = <<<JS
requirejs(['trender/app', 'jquery', 'vue', 't/zcollection'], 
function (app, $, Vue, zcollection){
    new Vue({
        el: '#collection-save',
        data: {
            obj:{
                name: '{$collection->name}',
                channelId: '{$collection->channelId}'
            },
            errors: [],
            alerts: false
        },
        methods: {
            save: function(obj){
                var self=this;
                if (!obj.name || !obj.label || !obj.audience)
                    return;
                zcollection.save(obj)
                .then(function (resp){
                    self.errors = [];
                    self.alerts = (obj.id)?'collection updated.' : 'collection created.';
                    self.wasCreated=true;
                    self.obj.id = resp.id;
                    self.obj.name = resp.name;
                }, function (error) {
                    self.alerts = false;
                    self.errors = error.errors;
                });
            }
        }
    });
});
JS;
$this->registerJs($scrip);