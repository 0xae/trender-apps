<?php
namespace app\models;
use yii\web\HttpException;

class Utils {
    public static function param($name) {
        if(!@$_GET[$name])
            throw new HttpException(400, "Parameter $name is mandatory.");
        return $_GET[$name];
    }

    public static function queryParam($name, $val) {
        return (@$_GET[$name]) ? $_GET[$name]: $val;
    }

    public static function cached($post) {
        $mediaHost = Trender::media();
        if (!isset($post->cached))
            return $post->picture;
        $cached = json_decode($post->cached);
        if ($post->cached == "none" || $post->cached == "" ||
                !$post->cached) {
            $url = $post->picture;
        } else {
            $url = "$mediaHost/media/{$post->cached}";
        }
        return $url;
    }

    public static function category($post) {
        $cat = false;
        $maxCategoryLen = 20;
        if (isset($post->category) && !empty($post->category)) {
            $category = implode(',', $post->category);

            $category = str_replace('%2b', ' ', $category);
            $category = str_replace('%2522', '', $category);
            $category = str_replace('%2526', '&', $category);
            $category = str_replace('+', ' ', $category);
            if (strlen($category) > $maxCategoryLen) {
                $category = substr($category, 0, $maxCategoryLen) . '...';
            }
            $cat = $category;
        }
        return $cat;
    }
}
