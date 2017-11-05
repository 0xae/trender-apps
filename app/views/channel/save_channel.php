<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$title = "Create a channel";
$descr = "Create channels to organize things, create stuff exploring the trender network";
$action='index.php?r=channel/create';
if ($model->id > 0) {
    $action='index.php?r=channel/update&id=' . $model->id;
    $title = "Edit channel #" . $model->name;
}

$this->title = $title;
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
            "@app/views/channel/menu_channel.php", [
                "menuConf" => [
                    "label" => $title,
                    "descr" => $descr
                ]
            ]
        );
    ?>
    </div>

    <div class="col-md-10" style="padding: 0px;min-height: 600px;background-color: #f7f3f3;">
        <div class="row rs-row" style="height: 400px;">
            <div class="col-md-6 col-md-push-3">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:12px;color:brown">
                        <strong>Create me a brand new channel</strong>
                    </div>
                    <div class="panel-body">
                        <?php $form = ActiveForm::begin(['action' => $action]);  ?>
                        <?= $form->field($model, 'name')->textInput() ?>
                        <?php
                        echo $form->field($model, 'audience')->dropdownList([
                                'public' => 'Public (for plugins, new stuff)', 
                                'private' => 'Internal (for development)'
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
