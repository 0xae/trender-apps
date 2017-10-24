<?php
namespace app\controllers;
use yii\web\HttpException;
use app\models\Timeline;

class SearchController extends \yii\web\Controller {
    public function actionIndex() {
        echo json_encode([
            "id" => 10,
            "title" => "testing stuff 1 2 3 4"
        ]);
    }
}

