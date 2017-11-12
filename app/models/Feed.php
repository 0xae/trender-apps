<?php
namespace app\models;
use Yii;
use app\models\Channel;
use app\models\HttpReq;
use app\models\Utils;
use app\models\Solr;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class Feed {
    public static function create($chan) {
        $queryConf = $chan->json('queryConf');
        $fq = explode(',', Utils::queryParam('fq', ''));
        foreach ($fq as $f) {
            $queryConf->fq[] = $f;
        }

        $q = $queryConf->q;
        $fq = $queryConf->fq;
        $fq[] = "!cached:none";
        $fq[] = "type:youtube-post";
    	$start = 0;
        $limit = 40;
        $vidReq = Solr::query($q, $start, $limit, $fq);

        $fq = $queryConf->fq;
        $fq[] = '!type:youtube-post';
        $fq[] = '!cached:none';

        $postReq = Solr::query($q, $start, $limit, $fq);

        $videos = $vidReq->response->docs;
        $posts = $postReq->response->docs;
        $data = $postReq->facet_counts->facet_fields->category;
        $groups = [];

        for ($i=0; $i<count($data) / 2;$i+=2) {
            $label = $data[$i];
            $score = $data[$i+1];

            // XXX: whats going on here?
            if ($score == 0 || $label==$q)
                continue;

            $groups[] = [
                "label" => $label,
                "score" => $score
            ];
        }

        foreach ($posts as $p) {
            $p->timestampFmt = \app\models\DateUtils::dateFmt($p->timestamp);
        }

        foreach ($videos as $p) {
            $p->timestampFmt = \app\models\DateUtils::dateFmt($p->timestamp);
        }

        return [
        	'videos' => $videos,
            'posts' => $posts,
            'groups' => $groups
        ];
    }
}
