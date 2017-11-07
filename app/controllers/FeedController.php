<?php
namespace app\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Post;
use app\models\Solr;


class FeedController extends \yii\web\Controller {
    public $layout = 'feed_layout';

    public function actionIndex() {
    	$q = '*';
    	$start = rand(0, 1000);
        $vidReq = Solr::query($q, $start, 20, [
            "!cached:none",
            "type:youtube-post"
        ]);

        $postReq = Solr::query($q, $start, 70, [
            '!type:youtube-post',
            '!cached:none'
        ]);

        $videos = $vidReq->response->docs;
        $posts = $postReq->response->docs;

        foreach ($posts as $p) {
            $p->timestampFmt = \app\models\DateUtils::dateFmt($p->timestamp);
            # $p->picture = $p->cached;
        }

        foreach ($videos as $p) {
            $p->timestampFmt = \app\models\DateUtils::dateFmt($p->timestamp);
            # $p->picture = $p->cached;
        }

        return $this->render('index', [
        	'videos' => $videos,
        	'posts' => $posts
        ]);
    }
}
