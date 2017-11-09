<?php
use yii\widgets\ActiveForm;
use yii\helpers\BaseHtml;
use yii\helpers\Html;

?>


<?php $form = ActiveForm::begin(['options' => [
								 'id' => 'collection-save',
                                 //'v-on:submit' => 'save'
                                 'v-on:submit.prevent'=>""
                                 ]]); ?>

<div class="alert alert-danger tr-alert" v-if="errors.length > 0">
    Oops, could save collection.<br/>
    <ul>
        <li v-for="e in errors">
            {{e}}
        </li>
    </ul>
</div>

<div class="form-body">
<?= $form->field($model, 'channelId')
    ->hiddenInput(['v-model'=>'obj.channelId'])
    ->label(false);
?>

<?= $form->field($model, 'name')
    ->textInput(['v-model'=>'obj.name', "required"=>"true"])
    ->label("Name <span class='tips'>used to get access to this collection</span>")
?>

<?= $form->field($model, 'label')
    ->textInput(['v-model'=>'obj.label']) 
    ->label("Label <span class='tips'>the title of your collection</span>")
?>

<?php
	echo $form->field($model, 'audience')->dropdownList([
	        'public' => 'Publicy accessible', 
	        'private' => 'Private (developers only)'
	    ],
	    ['prompt'=>'Select',
         'v-model'=>'obj.audience']
	)
	->label("Audience <span class='tips'>who can acess this?</span>");
?>
</div>

<div class="form-bottom">
<?= Html::submitButton('<strong>SAVE</strong>', [
    'class' => 'btn-sm btn btn-success',
    '@click' => 'save(obj)'
]) ?>
</div>

<?php ActiveForm::end(); ?>


<?php
$scrip = <<<JS
requirejs(['trender/app', 'jquery', '_', 'vue', 't/zcollection'], 
function (app, jQuery, _, Vue, zcollection){
    var onSave = $onSave;
    new Vue({
        el: '#collection-save',
        data: {
            obj:{
                name: '{$model->name}',
                channelId: '{$model->channelId}'
            },
            errors: []
        },
        methods: {
            save: function(obj){
                var self=this;
                if (!obj.name || !obj.label || !obj.audience)
                    return;
                zcollection.save(obj)
                .then(function (obj){
                    onSave(obj);
                }, function (error) {
                    self.errors = error.errors;
                });
            }
        }
    });
});
JS;
$this->registerJs($scrip);