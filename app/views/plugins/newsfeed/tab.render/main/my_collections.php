<?php
use yii\helpers\Html;
use app\models\collection;
$collection=new Collection;
?>

<div class="col-md-6">
    <h2>Your collections</h2>
    <div class="list-group">
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
</div>

<div class="col-md-6">
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