<?php
namespace app\models;

class Solr {
    public static function query($q, $lim, $facetq) {
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
}

