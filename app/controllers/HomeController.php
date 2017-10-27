<?php
namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Post;

/**
 * HomeController
 */
class HomeController extends Controller {
    /**
     * controller index
     * @return mixed
     */
    public function actionIndex() {
        return $this->render('index', [
        ]);
    }

    public function actionTest() {
        # $q = isset($_GET['q']) ? $_GET['q'] : 'bitcoin';
        # $query = urlencode($q);
        # $result = file_get_contents("http://localhost:8983/solr/trender/select?q={$query}&wt=phps");
        # $data = unserialize($result);
    }
}

