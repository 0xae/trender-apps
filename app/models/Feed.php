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
    const STEEMIT = 'steemit-post';
    const types = [
        self::STEEMIT,
        'youtube-post',
        'twitter-post',
        'bbc-post'
    ];

    //$groups = [];
    //$len = count($data)/2;

    //for ($i=0;$i<$len;$i+=2) {
    //    $label = $data[$i];
    //    $score = $data[$i+1];

    //    // XXX: whats going on here?
    //    if ($score == 0 || $label==$q) {
    //        continue;
    //    }

    //    $groups[] = [
    //        "label" => $label,
    //        "score" => $score
    //    ];
    //}

    public static function ofChannel($id) {
        # News, Places, Events, Videos
        $chan = self::channel($id);
        $fq=explode(',', Utils::queryParam('fq', ''));
        $queryConf=$chan->json('queryConf');
        $q=$queryConf->q;
        $start=0;
        $limitPerType=80;
        $postPerGroup=4;
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

        $syscol=Collection::byId(1);
        $syscol->display=true;
        // $news = clone $syscol;$news->label='News';
        // $places= clone $syscol;$places->label='Places';
        $more=clone $syscol;$more->label='More';
        $videos=clone $syscol;$videos->label='Videos';
        $newsfeed=clone $syscol;$newsfeed->label='Newsfeed';
        $chan->collections=[
            $newsfeed,
            $videos,
            $more
        ];

        do {
            $k=self::types[rand(0, count(self::types)-1)];
            $t=$types[$k];
            $docs=$t->response->docs;
            if (!empty($docs)) {
                $idx=rand(0, count($docs)-1);
                $featuredP=$docs[$idx];
                $featuredP->description=substr($featuredP->description, 0, 200);
            }
        } while ($found > 0 && empty($docs));
        
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

    private static function channel($id) {
        $name = Utils::queryParam('name', false);

        if ($id) {
            $chan = Channel::byId($id);
        } else if ($name) {
            try {
                $chan = Channel::byName($name);
            } catch (NotFoundHttpException $e) {
                $fq=Utils::queryParam('fq', '');
                $o = new Channel;
                $o->name = $name;
                // $o->label = Html::enco;
                $o->audience = 'public';
                #XXX: Html::encode() ?
                $o->queryConf = json_encode([
                    #q is mandatory
                    #no, i wont assuming its the same as $name
                    'q' => Utils::param('q'),
                    'fq' => explode(',', $fq)
                ]);
                $chan = $o->save();
            }
        } else {
            throw new HttpException(400, 'query param id or name are mandatory');
        }

        return $chan;        
    }
}
