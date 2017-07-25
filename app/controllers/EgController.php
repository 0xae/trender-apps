<?php
namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HomeController
 */
class EgController extends Controller {
    /**
     * controller index
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index', []);
    }
}

