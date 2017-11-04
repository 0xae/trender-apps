<?php
namespace app\models;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

class HttpReq extends \yii\base\Object {
    public static function get($query) {
        $json = json_decode(file_get_contents($query));
        # if (!$json) {
        #     throw new HttpException(400, $query);
        # }
        return $json;
    }
}

