<?php
namespace app\models;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

class Timeline extends \yii\base\Object {
    public static function byId($id) {
        $query = 'http://127.0.0.1:5000/api/timeline/' . $id;
        $json = self::get($query);
        return $json;
    }

    public static function stream($id, $limit) {
        $query = 'http://127.0.0.1:5000/api/timeline/' . $id . '/stream?limit='.$limit;
        $json = self::get($query);
        return $json;
    }

    private static function get($query) {
        $json = json_decode(@file_get_contents($query));
        if (!$json) {
            throw new HttpException(400, $query);
        }

        return $json;
    }
}

