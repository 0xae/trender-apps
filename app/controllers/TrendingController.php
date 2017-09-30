<?php

namespace app\controllers;

class TrendingController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
