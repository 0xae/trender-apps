<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$action='index.php?r=channel/update&id=' . $model->id;
$title = "#<a href='#'>" . $model->name . '</a>';
$descr = "Create channels to organize things, create stuff exploring the trender network";

$this->title = "Watching {$model->name}";
?>

<div class="row rs-row tr-header-panel">
    <div class="col-md-12 tr-header-inner">
        <h1>
            <center>
            <span class="glyphicon glyphicon-random"></span>
            <?= $model->name ?>
            </center>
        </h1>
    </div>
</div>

<div class="row rs-row" style="height: 400px;">
    <div class="col-md-2">
        <h4>
            <span class="fa fa-lock <?= ($model->audience=='public') ? 'text-warning' : 'text-success' ?> "></span>
            Watching a <?= $model->audience ?> channel
        </h4>
        <p>you are watching <strong><a href="#"><?= $model->name ?></a>.</strong></p>
    </div>

    <div class="col-md-10" style="padding: 0px;min-height: 600px;background-color: #f7f3f3;">
        <div class="row rs-row" style="height: 400px;">
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading" style="font-size:12px;color:gray">
                        <strong><?= $title ?></strong>
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

<?php
$scrip = '';