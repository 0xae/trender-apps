<?php
namespace app\models;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\base\Model;
use yii\db\ActiveRecord;

class Channel extends Model {
    public $id=0;
    public $name;
    public $picture=null;
    public $queryConf='{}';
    public $curation=0;
    public $rank=-1;
    public $intel='{}';
    public $audience='private';
    public $createdAt;
    public $lastUpdate;
    public $lastUpdateFmt;

    public function rules() {
        return [
            [['name'], 'required'],
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'string', 'min' => 3],
            ['id', 'integer'],
        ];
    }

    private static function convert_to($i) {
        $c = new Channel;
        $c->id = $i->id;
        $c->rank = $i->rank;
        $c->queryConf = $i->queryConf ;
        $c->picture = $i->picture ;
        $c->name = $i->name ;
        $c->audience = $i->audience ;
        $c->intel = $i->intel ;
        $c->curation = $i->curation ;
        $c->createdAt = $i->createdAt ;
        $c->lastUpdate = $i->lastUpdate ;
        $c->lastUpdateFmt = $i->lastUpdateFmt;
        return $c;
    }

    public function save() {
        $host = Trender::apiHost();
        $data = [                
            "rank" => $this->rank,
            "name" => $this->name,
            "audience" => $this->audience,
            "queryConf" => $this->queryConf,
            "picture" => $this->picture,
            "intel" => $this->intel,
            "curation" => $this->curation
        ];

        if ($this->id > 0) {
            $url = "http://{$host}/api/channel/{$this->id}";
            $data['id']=$this->id;
        } else {
            $url = "http://{$host}/api/channel/new";
        }

        $json = HttpReq::post($url, json_encode($data));
        if (!$this->id) $this->id = $json->id;
        return $json;
    }

    public static function byId($id) {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/channel/$id";
        $json = HttpReq::get($query);
        return self::convert_to($json);
    }

    // encode $name ???
    public static function byName($name, $q='*') {
        $host = Trender::apiHost();
        $q = urlencode($q);
        $query = "http://{$host}/api/channel/find_by?name=$name&q=$q";
        $json = HttpReq::get($query);
        return self::convert_to($json);
    }

    public static function all() {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/channel";
        return HttpReq::get($query);
    }

    public static function find($audience='public') {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/channel/find?audience=$audience";
        $ret= HttpReq::get($query);
        return $ret;
    }
}
