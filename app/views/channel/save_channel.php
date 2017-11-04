<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$action='index.php?r=channel/create';
if ($model->id > 0) {
    $action='index.php?r=channel/update&id=' . $model->id;
}
?>

<div class="row rs-row tr-header-panel">
    <div class="col-md-12 tr-header-inner">
        <h1>
            <center>
            <span class="glyphicon glyphicon-random"></span>
            Channels
            </center>
        </h1>
    </div>
</div>

<div class="row rs-row" style="height: 400px;">
    <div class="col-md-2">
    <?php
        echo \Yii::$app->view->renderFile (
            "@app/views/channel/menu_channel.php", []
        );
    ?>
    </div>

    <div class="col-md-10" style="padding: 0px;min-height: 600px;background-color: #f7f3f3;">
        <div class="row rs-row" style="height: 400px;">
            <div class="col-md-6 col-md-push-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Create a channel</div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['action' => $action]);  ?>
                        <?= $form->field($model, 'name')->textInput() ?>
                        <?php
                        echo $form->field($model, 'internal')->dropdownList([
                                0 => 'Public (for plugins, new stuff)', 
                                1 => 'Internal (for development)'
                            ],
                            ['prompt'=>'Select']
                        )
                        ->label('Audience');
                        ?>
                        <div class="form-group">
                            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
