<?php
namespace app\models;

class Trender {
    public static function server() {
        $json = file_get_contents('trender.conf');
        $conf = json_decode($json);
        return $conf->trender_host;
    }

    public static function solr() {
        $json = file_get_contents('trender.conf');
        $conf = json_decode($json);
        return $conf->solr_host;
    }

    public static function api() {
        $json = file_get_contents('trender.conf');
        $conf = json_decode($json);
        return $conf->trender_api;
    }

    public static function media() {
        $json = file_get_contents('trender.conf');
        $conf = json_decode($json);
        return $conf->trender_media_host;
    }
}
