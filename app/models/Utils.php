<?php
namespace app\models;

class Utils {
    public static function cached($post) {
        $cached = json_decode($post->cached);
        if ($post->cached == "none" || $post->cached == "" ||
                !$post->cached) {
            $url = $post->picture;
        } else if (is_array($cached)) {
            $url = '../downloads/' . $cached[0];
        } else if (!$cached) {
            $url = '../' . $post->cached;
        }

        return $url;
    }
}
