<?php
namespace app\models;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

class Timeline extends \yii\base\Object {
    public static function byId($id) {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/timeline/$id";
        $json = self::get($query);
        return $json;
    }

    public static function stream($id, $limit, $start=false) {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/timeline/$id/stream?limit=$limit";

        if ($start) {
            $query .= '&start=' . $start;
        }

        $json = self::get($query);
        return $json;
    }

    public static function search($topic, $limit=40) {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/timeline/topic/$topic"
                    . '?limit=' . $limit;
        return self::get($query);
    }

    public static function all($state='*') {
        $host = Trender::apiHost();
        $query = "http://{$host}/api/timeline?state=" . $state;
        return self::get($query);
    }

    private static function get($query) {
        $json = json_decode(file_get_contents($query));
        # if (!$json) {
        #     throw new HttpException(400, $query);
        # }
        return $json;
    }
}

