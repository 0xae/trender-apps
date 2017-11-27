<?php
namespace app\models;

use Yii;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;
use app\models\Channel;
use app\models\DateUtils;
use app\models\HttpReq;
use app\models\Solr;
use app\models\Utils;

class Feed {
    public static function ofChannel($id) {
        # News, Places, Events, Videos
        $chan = self::channel($id);
        $fq=explode(',', Utils::queryParam('fq', ''));
        $queryConf=$chan->json('queryConf');
        $q=$queryConf->q;
        $start=0;
        $limitPerType=80;
        $featuredP=false;
        $fq=$queryConf->fq;
        $types=[];
        $found=0;

        foreach ($fq as $f) {
            $queryConf->fq[] = $f;
        }

        foreach (self::types as $type) {
            $req = Solr::query($q, $start, $limitPerType, 
                self::ary($fq, 
                    '!cached:none', 
                    "type:$type"
                )
            );

            $types[$type] = $req;
            $found += count($req->response->docs);
            foreach ($req->response->docs as &$p) {
                self::treat($p);
                $all[] = $p;
            }
        }



        return [
            'channel' => $chan,
            'featuredPost' => $featuredP
        ];
    }

    private static function ary($ary, ...$elements) {
        foreach ($elements as $el) {
            $ary[] = $el;
        }
        return $ary;
    }

    private static function treat(&$p) {
        $p->timestampFmt = DateUtils::dateFmt($p->timestamp);
        $p->description = Html::encode($p->description);
        $p->authorName = Html::encode($p->authorName);

        if (!isset($p->collections)) {
            $p->collections = [];
        }
    }
}
