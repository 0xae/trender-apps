<?php
namespace app\models;

class Feed extends \yii\base\Object {

    public static function fromSolrResp($resp) {
        return $resp;
    }
}

