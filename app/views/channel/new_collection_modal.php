<?php
use app\models\Collection;
$collection->channelId = $channel->id;
$collection->audience = 'private';
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
                    <span v-if="!obj.id">
                        <?= ($collection->id) ? "Collection {$collection->name}" : "Create a collection" ?>
                    </span>
                    <span v-if="obj.id">
                        {{obj.name}}
                    </span>
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
    var colObj = {
        id: '{$collection->id}',
        name: '{$collection->name}',
        channelId: '{$collection->channelId}',
        audience: '{$collection->audience}'
    };

    var collection = new Vue({
        el: '#collectionModal',
        data: {
            obj: colObj,
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
                }, function (data) {
                    self.alerts = false;
                    if (data.errors)
                        self.errors = data.errors;
                    else if (data.statusText)
                        self.errors = [data.statusText];
                    else
                        self.errors = [data];
                });
            }
        }
    });
});
JS;
$this->registerJs($scrip);