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
use app\models\Channel;

class FeedController extends \yii\web\Controller {
    public $layout = 'feed_layout';

    public function actionIndex() {
        $top_channels = Channel::sugestions('top');
        $recent_channels = Channel::sugestions('recent');
        $sg = [
            "top_channels" => $top_channels,
            "recent_channels" => $recent_channels
        ];

        // TODO: get rid of this dependency
        $req = Solr::query("*", 0, 70, [
            '!cached:none'
        ]);

        $data = $req->facet_counts->facet_fields->category;
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

        return $this->render('index', [
        	'videos' => [],
            'posts' => [],
            'trending' => $trending,
            'sugestions' => $sg
        ]);
    }
}
