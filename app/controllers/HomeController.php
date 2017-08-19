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
        $data = Post::search('news', 20);
        return $this->render('index', [
            'posts' => $data["posts"]
        ]);
    }

    public function actionTimeline() {
        $query = isset($_GET['q']) ? $_GET['q'] : 'news';
        $data = Post::search($query);

        return $this->renderPartial('timeline', [
            'posts' => $data["posts"]
        ]);
    }

    public function actionTest() {
        # $q = isset($_GET['q']) ? $_GET['q'] : 'bitcoin';
        # $query = urlencode($q);
        # $result = file_get_contents("http://localhost:8983/solr/trender/select?q={$query}&wt=phps");
        # $data = unserialize($result);

        $data = Post::search('news');
        return $this->renderPartial('test', [
            'model' => $data["posts"]
        ]);
    }
}

