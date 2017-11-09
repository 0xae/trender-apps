<?php
namespace app\controllers;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\BaseHtml;
use app\models\Post;
use app\models\Solr;

class FeedController extends \yii\web\Controller {
    public $layout = 'feed_layout';

    public function actionIndex() {
    	$q = (@$_GET['q']) ? $_GET['q'] : '*';
    	$start = 0;
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
        $data = $postReq->facet_counts->facet_fields->category;
        $trending = [];
        for ($i=0; $i<count($data) / 2;$i+=2) {
            $score = $data[$i+1];
            if ($score == 0)
                continue;

            $trending[] = [
                "label" => $data[$i],
                "score" => $score
            ];
        }

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
            'posts' => $posts,
            'trending' => $trending,
            'channel_name' => ($q=='*') ? 'Newsfeed' : $q,
            'q' => BaseHtml::encode($q)
        ]);
    }
}
