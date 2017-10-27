<?php
namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Post;
use app\models\Solr;

/**
 * HomeController
 */
class HomeController extends Controller {
    /**
     * controller index
     * @return mixed
     */
    public function actionIndex() {
        $start = rand(0, 1000);
        $vidReq = Solr::query("*", $start, 20, "type:youtube-post");
        $postReq = Solr::query("*", $start, 40, false);
        $videos = $vidReq->response->docs;
        $posts = $postReq->response->docs;
        
        $trendingCats = $postReq->facet_counts->facet_fields->category;
        $trendingTypes = $postReq->facet_counts->facet_fields->type;

        // XXX
        foreach ($posts as $p) {
            $p->timestampFmt = '123';
            $p->picture = $p->cached;
        }

        return $this->render('index', [
            "videos" => $videos,
            "posts" => $posts,
            "trendingCats" => $trendingCats
        ]);
    }

    public function actionTest() {
        # $q = isset($_GET['q']) ? $_GET['q'] : 'bitcoin';
        # $query = urlencode($q);
        # $result = file_get_contents("http://localhost:8983/solr/trender/select?q={$query}&wt=phps");
        # $data = unserialize($result);
    }
}

