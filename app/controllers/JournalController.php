<?php

namespace app\controllers;

class JournalController extends \yii\web\Controller {
    public function actionIndex()
    {
        return $this->render('index');
    }

}
