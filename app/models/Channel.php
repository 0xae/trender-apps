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
    public $internal=true;
    public $createdAt;

    public function rules() {
        return [
            [['name'], 'required'],
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'string', 'min' => 3],
            ['id', 'integer'],
            ['internal', 'boolean']
        ];
    }

    public function save() {
        $host = Trender::apiHost();
        $data = [                
            "name" => $this->name,
            "internal" => $this->internal ? 'true' : 'false'
        ];

        if ($this->id > 0) {
            $url = "http://{$host}/api/channel/{$this->id}";
            $data['id']=$this->id;
        } else {
            $url = "http://{$host}/api/channel/new";
        }

        $json = HttpReq::post($url, json_encode($data));
        if (!$this->id) $this->id = $json->id;
        return true;
    }

    public static function byId($id) {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/channel/$id";
        $json = HttpReq::get($query);
        return self::convert_to($json);
    }

    public static function all() {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/channel";
        return HttpReq::get($query);
    }

    private static function convert_to($i) {
        $c = new Channel;
        $c->id = $i->id;
        $c->rank = $i->rank;
        $c->queryConf = $i->queryConf ;
        $c->picture = $i->picture ;
        $c->name = $i->name ;
        $c->internal = $i->internal ;
        $c->intel = $i->intel ;
        $c->curation = $i->curation ;
        $c->createdAt = $i->createdAt ;
        return $c;
    }

    public static function find($audience='public') {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/channel/find?audience=$audience";
        return HttpReq::get($query);
    }
    //TODO: create & update
}
