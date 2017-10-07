<?php
namespace app\models;

class DateUtils {
    public static function formatToHuman($date) {
        return date("F jS  Y", strtotime($date));
    }
}

