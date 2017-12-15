<?php
use yii\widgets\ActiveForm;
use yii\helpers\BaseHtml;
use yii\helpers\Html;

if (!$model->id) {
    $model->name = Yii::$app->security->generateRandomString(10);
    if ($model->channelId) {
        $model->name = "{$model->channelId}-{$model->name}";
    }
}
?>

<?php $form = ActiveForm::begin(['options' => [
								 'id' => 'collection-save',
                                 //'v-on:submit' => 'save'
                                 'v-on:submit.prevent'=>""
                                 ]]); ?>

<div class="alert alert-success tr-alert" v-if="alerts">
    <strong>
        <span class="fa fa-lock"></span> 
        {{alerts}}
    </strong>
</div>

<div class="alert alert-danger tr-alert" v-if="errors.length > 0">
    <span class="pull-right label label-danger">ERROR</span>
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
    ->hiddenInput(['v-model'=>'obj.name', 
                "id"=>"colName"])
    ->label(false)
?>

<?= $form->field($model, 'label')
    ->textInput(['v-model'=>'obj.label',
                'placeholder' => "My collection"]) 
    ->label("Label <span class='tips'>the title of your collection</span>")
?>

<?php
	echo $form->field($model, 'audience')->dropdownList([
	        'public' => 'Publicy accessible', 
	        'private' => 'Private (developers only)'
	    ],
	    ['v-model'=>'obj.audience']
	)
	->label("Audience <span class='tips'>who can acess this?</span>");
?>
</div>

<div class="form-bottom">
<?= Html::submitButton('<strong>save</strong>', [
    'class' => 'btn-sm btn btn-success tr-btn',
    '@click' => 'save(obj)'
]) ?>
</div>

<?php ActiveForm::end(); ?>

