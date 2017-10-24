<?php
namespace app\models;

class Trender {
    public static function apiHost() {
        $api = getenv("TRENDER_API");
        if (!$api) {
            $api = "192.168.1.85:5000";
        }
        return $api;
    }
}