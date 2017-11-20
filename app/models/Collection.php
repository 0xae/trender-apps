<?php
namespace app\models;
use Yii;
use app\models\Channel;
use app\models\HttpReq;
use app\models\Utils;
use app\models\DateUtils;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\base\Model;
use yii\db\ActiveRecord;

class Collection extends Model {
    public $id, $name, $label, $description;
    public $audience, $channelId, $display, $update, $curation;
    public $createdAt, $createdAtFmt, $lastUpdate, $lastUpdateFmt;
    public $posts=[];
    public $groups=[];

    public function Collection() {
    }

    public function rules() {
        return [
            [['label', 'label', 'audience', 'name'], 'required'],
            [['id', 'channelId'], 'integer']
        ];
    }

    private static function convert($json) {
        $coll = new Collection;
        $coll->id = $json->id;
        $coll->name = $json->name;
        $coll->label = $json->label;
        $coll->description = $json->description;
        $coll->audience = $json->audience;
        $coll->display = $json->display;
        $coll->update = $json->update;
        $coll->curation = $json->curation;

        $coll->createdAt = $json->createdAt;
        $coll->createdAtFmt = $json->createdAtFmt;

        $coll->lastUpdate = $json->lastUpdate;
        $coll->lastUpdateFmt = $json->lastUpdateFmt;
        return $coll;
    }

    public static function byId($id) {
        $host = Trender::api();
        $query = "{$host}collection/$id";
        $json = HttpReq::get($query);
        return self::convert($json);
    }

    public static function all($audience='public') {
        $host = Trender::api();
        $query = "{$host}collection?audience=$audience";
        $ary = [];
        $all=HttpReq::get($query);
        foreach ($all as $col) {
            $ary[] = self::convert($col);
        }

        return $ary;
    }

    public function posts($chan, $start=0, $lim=20) {
        $queryConf = $chan->json('queryConf');
        $q = $queryConf->q;
        $fq = $queryConf->fq;
        $fq[] = 'collections:'.$this->name;
        $req = Solr::query($q, $start, $lim, $fq);

        $posts = $req->response->docs;
        foreach ($posts as $p) {
            $p->timestampFmt = DateUtils::dateFmt($p->timestamp);
        }

        return $posts;
    }

    public function save() {
        $host=Trender::api();
        if ($this->name !="") {
            $random=Yii::$app->security->generateRandomString();
            $this->name = "$random";
            if ($this->channelId > 0)
                $this->name = "{$this->channelId}/{$this->name}";
        }

        $data = json_encode($this);
        if ($this->id > 0) {
            $url = "{$host}collection/{$this->id}";
        } else {
            $url = "{$host}collection/new";
        }

        $json = HttpReq::post($url, $data);
        if (!$this->id) 
            $this->id = $json->id;
    }
}
