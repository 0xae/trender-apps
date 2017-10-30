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
    public $layout = 'bootstrap_layout';

    /**
     * controller index
     * @return mixed
     */
    public function actionIndex() {
        # $start = 0;
        $q = (@$_GET['q']) ? $_GET['q'] : '*';
        $c = (@$_GET['c']) ? "category={$_GET['c']}" : false;
        $t = (@$_GET['t']) ? $_GET['t'] : false;
        $start = (@$_GET['s']) ? $_GET['s'] : 0;

        $vidReq = Solr::query($q, $start, 20, [
            "!cached:none",
            "type:youtube-post",
            $c, $t
        ]);

        $postReq = Solr::query($q, $start, 70, [
            #'!type:youtube-post',
            #'type:youtube-post',
            '!cached:none',
            $c, $t
        ]);

        $videos = $vidReq->response->docs;
        $posts = $postReq->response->docs;
        
        $trendingCats = $postReq->facet_counts->facet_fields->category;
        # $trendingTypes = $postReq->facet_counts->facet_fields->type;

        // XXX
        foreach ($posts as $p) {
            $p->timestampFmt = \app\models\DateUtils::dateFmt($p->timestamp);
            # $p->picture = $p->cached;
        }

        if ($q != '*') {
            $label = $q;
        } else if ($c) {
            $label = $_GET['c'];
        } else {
            $label = 'Home';
        }

        return $this->render('index', [
            "videos" => $videos,
            "posts" => $posts,
            "trendingCats" => $trendingCats,
            "label" => $label
        ]);
    }

    public function actionTest() {
        # $q = isset($_GET['q']) ? $_GET['q'] : 'bitcoin';
        # $query = urlencode($q);
        # $result = file_get_contents("http://localhost:8983/solr/trender/select?q={$query}&wt=phps");
        # $data = unserialize($result);
    }
}

