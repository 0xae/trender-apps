<?php
use yii\helpers\Html;
use app\models\collection;
$collection=new Collection;
?>

<!-- collections list  -->
<div class="col-md-5 tx-collection-list">
    <h2>Your collections</h2>
    <div class="list-group" style="min-height:500px">
        <?php foreach($collections as $coll): ?>
            <a href="#" class="list-group-item active">
                <h4 class="list-group-item-heading">
                    <?= Html::encode($coll->label); ?><br/>
                    <small> <strong><?= Html::encode($coll->name) ?></strong> </small>
                </h4>
                <p class="list-group-item-text">
                </p>
            </a>
        <?php endforeach; ?>
    </div>

    <p class="tx-btn-descr">
        There are <a href="#">3 more</a> collections
        <span class="pull-right">10 collections</span>
    </p>

    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-warning">
                <strong>Load more</strong>
            </button>
        </div>
    </div>
</div>

<!-- collection form -->
<div class="col-md-5 pull-right tx-collection-form">
    <h2>Create a collection</h2>
    <div id="collectionForm">
        <?php
            echo \Yii::$app->view->renderFile(
                "@app/views/collection/save.php",
                ["model" => $collection]
            );
        ?>
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
        el: '#collectionForm',
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