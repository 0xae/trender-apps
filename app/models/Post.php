<?php
namespace app\models;

class Post extends \yii\base\Object {
    public $data;
    public $authorName;
    public $description;
    public $timestampFmt;

    public static function search($q, $lim) {
        $results = Solr::query($q, $lim, false);
        $docs = $results['response']['docs'];

        $posts = [];
        foreach ($docs as $p) {
            $p['json'] = json_decode($p['data'], true);
            $posts[] = $p;
        }

        return [
            "posts" => $posts,
            "categories" => $results["facet_counts"]["facet_fields"],
            "_q" => $results
        ];
    }
}

