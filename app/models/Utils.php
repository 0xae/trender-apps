<?php
namespace app\models;

class Utils {
    public static function cached($post) {
        if (!isset($post->cached))
            return $post->picture;

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

    public static function category($post) {
        $cat = false;
        $maxCategoryLen = 20;

        if (isset($post->category) && count($post->category)) {
            $category = $post->category[0];
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
