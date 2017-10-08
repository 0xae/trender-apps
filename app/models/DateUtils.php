<?php
namespace app\models;

class DateUtils {
    public static function formatToHuman($date) {
        return date("F jS  Y", strtotime($date));
    }

    public static function youtubeFmt($date) {
        return date("Y-m-d H:i", strtotime($date));
    }
}

