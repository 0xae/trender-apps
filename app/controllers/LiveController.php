<?php
namespace app\controllers;

class LiveController extends \yii\web\Controller {
    public function actionIndex() {
        return $this->render('index');
    }
}

