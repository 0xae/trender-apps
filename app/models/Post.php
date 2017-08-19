<?php
namespace app\models;

class Post extends \yii\base\Object {
    public static function query($q, $lim=50, $facetq=false) {
        $query = urlencode($q);
        $limit = (int)$lim;
        $query = "http://localhost:8983/solr/trender/query?q={$query}";
        $query .= "&facet=true";
        $query .= "&facet.field=category";
        $query .= "&facet.field=type";
        $query .= "&rows={$limit}";
        $query .= "&sort=timestamp+desc";
        $query .= "&wt=phps";

        if ($facetq) {
            $facet_query = urlencode($facetq);
            $query = $query . "&fq={$facet_query}";
        }

        $result = file_get_contents($query);
        return unserialize($result);
    }

    public static function search($q) {
        $results = self::query($q);
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

