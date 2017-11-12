<?php
namespace app\models;

class Solr {
    public static function query($q, $start, $lim, $facetq) {        
        $qFmt = urlencode($q);
        $solrHost = Trender::solr();
        $limit = (int)$lim;

        $url = "{$solrHost}/solr/trender/query?";
        $url .= "q={$qFmt}";
        $url .= "&facet=true";
        $url .= "&facet.field=category";
        $url .= "&facet.field=type";
        $url .= "&rows={$limit}";
        $url .= "&start={$start}";
        $url .= "&sort=timestamp+desc";
        $url .= "&wt=json";

        if ($facetq && is_array($facetq)) {
            $buf = '';
            foreach ($facetq as $fq) {
                if ($fq && strlen($fq) > 0) {
                    $buf .= "&fq=" . urlencode($fq);
                }
            }
            $url .= $buf;
        }

        return HttpReq::get($url);
    }
}

