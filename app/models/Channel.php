<?php
namespace app\models;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

class Channel extends \yii\base\Object {
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

    public static function find() {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/channel/find";
        return HttpReq::get($query);
    }

    //TODO: create & update
}

