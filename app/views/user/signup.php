<?php
use yii\widgets\ActiveForm;
use yii\helpers\BaseHtml;
use yii\helpers\Html;
?>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4" style="margin-top: 40px;">
        <?php $form = ActiveForm::begin(['options' => ['id' => 'signup-user',
                                                       'class' => 'tr-signup-form']]); ?>

        <div class="panel panel-default tr-signup-modal">
            <div class="panel-body">
                <h1 style="margin-top:0px;">Signup</h1>
                <?php if(!empty($errors)): ?>
                <div class="alert alert-danger tr-alert">
                    <span class="pull-right label label-danger">ERRORS OCURRED</span>
                    <ul>
                        <?php foreach ($errors as $e): ?>
                        <li><?= print_r($e,true) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
                <div class="form-body">
                <?= $form->field($model, 'name')
                          ->textInput(['placeholder' => 'Your name']); 
                ?>

                <?= $form->field($model, 'email')
                          ->textInput(['placeholder' => 'Your email', 'no-autocomplete'=>'no-autocomplete']); 
                ?>


                <?= $form->field($model, 'password')
                          ->passwordInput(['placeholder' => 'And your password']); 
                ?>
                </div>
            </div>

            <div class="panel-footer">
                <div class="form-bottom">
                <?= Html::submitButton('<strong>save</strong>', [
                    'class' => 'btn-sm btn btn-success tr-btn',
                    '@click' => 'save(obj)'
                ]) ?>
                </div>
            </div>
        </div>


        <?php ActiveForm::end(); ?>
    </div>
</div>

