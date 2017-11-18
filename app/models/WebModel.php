<?php
namespace app\models;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\base\Model;

class WebModel extends Model {
    public abstract function fromJson($json);
    public abstract function api();

    public function save() {
        $host = Trender::api();
        $data = json_encode($this);
        $api = $this->api();

        if ($this->id > 0) {
            $url = "{$host}{$api}/{$this->id}";
            $data['id']=$this->id;
        } else {
            $url = "{$host}{$api}/new";
        }

        $json = HttpReq::post($url, json_encode($data));
        if (!$this->id) {
            $this->id = $json->id;
        }
        return $this;
    }

    public function byId($id) {
        $host = Trender::api();
        $api = $this->api();
        $query = "{$host}{$module}/$id";
        $json = HttpReq::get($query);
        return self::convert_to($json);
    }

    public function all() {
        $host = Trender::api();
        $query = "{$host}{$module}";
        return HttpReq::get($query);
    }

    public function find($audience='public') {
        $host = Trender::api();
        $query = "{$host}channel/find?audience=$audience";
        $ret= HttpReq::get($query);
        return $ret;
    }
}