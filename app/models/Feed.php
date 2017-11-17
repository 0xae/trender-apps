<?php
namespace app\models;

use Yii;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

use app\models\Channel;
use app\models\HttpReq;
use app\models\Utils;
use app\models\Solr;

class Feed {
    public static function create($chan) {
        $queryConf = $chan->json('queryConf');
        $fq = explode(',', Utils::queryParam('fq', ''));
        foreach ($fq as $f) {
            $queryConf->fq[] = $f;
        }

        $q = $queryConf->q;
        $start = 0;
        $limit = 30;

        $fq1 = $queryConf->fq;
        $fq1[] = "!cached:none";
        $fq1[] = "type:youtube-post";
        $vidReq = Solr::query($q, $start, $limit, $fq1);

        $fq2 = $queryConf->fq;
        $fq2[] = '!type:youtube-post';
        $fq2[] = '!cached:none';
        $postReq = Solr::query($q, $start, $limit, $fq2);

        $videos = $vidReq->response->docs;
        $posts = $postReq->response->docs;
        $data = $postReq->facet_counts
                        ->facet_fields
                        ->category;
        $groups = [];
        $len = count($data)/2;

        for ($i=0;$i<$len;$i+=2) {
            $label = $data[$i];
            $score = $data[$i+1];

            // XXX: whats going on here?
            if ($score == 0 || $label==$q) {
                continue;
            }

            $groups[] = [
                "label" => $label,
                "score" => $score
            ];
        }

        foreach ($posts as $p) {
            $p->timestampFmt = \app\models\DateUtils::dateFmt($p->timestamp);
            if (!isset($p->collections)) {
                $p->collections = [];
            }
        }

        foreach ($videos as $p) {
            $p->timestampFmt = \app\models\DateUtils::dateFmt($p->timestamp);
            if (!isset($p->collections)) {
                $p->collections = [];
            }
        }

        return [
            'videos' => $videos,
            'posts' => $posts,
            'groups' => $groups
        ];
    }
}
