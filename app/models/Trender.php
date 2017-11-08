<?php
namespace app\models;

class Trender {
    public static function serverHost() {
        $json = file_get_contents('trender.conf');
        $conf = json_decode($json);
        return $conf->trender_host;
    }

    public static function apiHost() {
        $json = file_get_contents('trender.conf');
        $conf = json_decode($json);
        return $conf->trender_api;
    }

    public static function mediaHost() {
        $json = file_get_contents('trender.conf');
        $conf = json_decode($json);
        return $conf->trender_media_host;
    }
}
