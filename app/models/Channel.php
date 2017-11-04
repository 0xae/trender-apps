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
        if ($this->id > 0) {
            $url = "http://{$host}/api/channel/{$this->id}";
            $json = HttpReq::put($url, json_encode($this));
        } else {
            $url = "http://{$host}/api/channel/new";
            $data = [                
                "name" => $this->name,
                "internal" => $this->internal ? 'true' : 'false'
            ];
            $json = HttpReq::post($url, json_encode($data));
        }

        $this->id = $json->id;
        return true;
    }

    public static function byId($id) {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/channel/$id";
        $json = HttpReq::get($query);
        return $json;
    }

    public static function all() {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/channel";
        return HttpReq::get($query);
    }

    public static function find($audience='public') {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/channel/find?audience=$audience";
        return HttpReq::get($query);
    }
    //TODO: create & update
}
