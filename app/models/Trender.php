<?php
namespace app\models;

class Trender {
    private static function getConf($file="trender.conf") {
        $json = file_get_contents($file);
        $conf = json_decode($json);
        return $conf;
    }

    public static function server() {
        return self::getConf()->host;
    }

    public static function solr() {
        return self::getConf()->solr_host;
    }

    public static function api() {
        return self::getConf()->api;
    }

    public static function media() {
        return self::getConf()->media_host;
    }
}
