<?php
namespace app\models;

class Solr {
    public static function query($q, $start, $lim, $facetq) {        
        $qFmt = urlencode($q);
        $solrHost = Trender::solr();
        $limit = (int)$lim;

        $query = "{$solrHost}/solr/trender/query?";
        $query .= "q={$qFmt}";
        $query .= "&facet=true";
        $query .= "&facet.field=category";
        $query .= "&facet.field=type";
        $query .= "&rows={$limit}";
        $query .= "&start={$start}";
        $query .= "&sort=timestamp+desc";
        $query .= "&wt=json";

        if ($facetq && is_array($facetq)) {
            $buf = '';
            foreach ($facetq as $fq) {
                if ($fq && strlen($fq) > 0) {
                    $buf .= "&fq=" . urlencode($fq);
                }
            }
            $query .= $buf;
        }

        // XXX: replace this thing
        $result = file_get_contents($query);
        return json_decode($result);
    }
}

