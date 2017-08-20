<?php

namespace app\controllers;

class DiaryController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
