<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\Html;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;

class Channel extends Model {
    public $id=0;
    public $name;
    public $picture=null;
    public $description="";
    public $queryConf='{}';
    public $curation=0;
    public $rank=-1;
    public $intel='{}';
    public $audience='private';
    public $createdAt;
    public $lastUpdate;
    public $lastUpdateFmt;
    public $collections=[];

    public function rules() {
        return [
            [['name'], 'required'],
            ['name', 'filter', 'filter' => 'Html::encode'],
            ['name', 'string', 'min' => 3],
            ['id', 'integer'],
        ];
    }

    // TODO: fix this
    //       we should avoid writing code like that
    public function save() {
        $host = Trender::api();
        $data = [
            "rank" => $this->rank,
            "name" => $this->name,
            "audience" => $this->audience,
            "queryConf" => $this->queryConf,
            "picture" => $this->picture,
            "intel" => $this->intel,
            "description" => $this->description,
            "curation" => $this->curation
        ];

        if ($this->id > 0) {
            $url = "{$host}channel/{$this->id}";
            $data['id']=$this->id;
        } else {
            $url = "{$host}channel/new";
        }

        $json = HttpReq::post($url, json_encode($data));
        if (!$this->id) {
            $this->id = $json->id;
        }

        $this->lastUpdate = $json->lastUpdate ;
        $this->lastUpdateFmt = $json->lastUpdateFmt;
        return $this;
    }

    public function json($prop) {
        return json_decode($this->$prop);
    }

    private static function convert($i) {
        $c = new Channel;
        $c->id = $i->id;
        $c->rank = $i->rank;
        $c->queryConf = $i->queryConf ;
        $c->picture = $i->picture ;
        $c->name = $i->name ;
        $c->audience = $i->audience ;
        $c->description = $i->description ;
        $c->intel = $i->intel ;
        $c->curation = $i->curation ;
        $c->createdAt = $i->createdAt ;
        $c->lastUpdate = $i->lastUpdate ;
        $c->lastUpdateFmt = $i->lastUpdateFmt;
        $c->collections = array_map(function ($col){ return Collection::convert($col); }, $i->collections);
        return $c;
    }

    public static function retrieve($id, $name) {
        if ($id) {
            $chan = self::byId($id);
        } else if ($name) {
            try {
                $chan = self::byName($name);
            } catch (NotFoundHttpException $e) {
                $fq=Utils::queryParam('fq', '');
                $o = new Channel;
                $o->name = Html::encode($name);
                $o->description = "talks about {$o->name}";
                $o->audience = 'public';
                $o->queryConf = json_encode([
                    'q' => Utils::param('q'),
                    'fq' => explode(',', $fq)
                ]);
                $chan = $o->save();
            }
        } else {
            throw new HttpException(400, 'query param id or name are mandatory');
        }

        return $chan;        
    }

    public static function sugestions($name) {
        $host = Trender::api();
        $query = "{$host}channel/sugestions/$name";
        $all = HttpReq::get($query);
        $ary = [];
        foreach ($all as $c) {
            $ary[] = self::convert($c);
        }
        return $ary; 
    }

    public static function byId($id) {
        $host = Trender::api();
        $query = "{$host}channel/$id";
        $json = HttpReq::get($query);
        return self::convert($json);
    }

    /*
     ** TODO: encode $name ???
    */
    public static function byName($name, $q='*') {
        $host = Trender::api();
        $q = urlencode($q);
        $query = "{$host}channel/find_by?name=$name&q=$q";
        $json = HttpReq::get($query);
        return self::convert($json);
    }

    public static function all() {
        $host = Trender::api();
        $query = "{$host}channel";
        $ary = [];
        $all=HttpReq::get($query);
        foreach ($all as $col) {
            $ary[] = self::convert($col);
        }
        return $ary;
    }

    public static function find($audience='public') {
        $host = Trender::api();
        $query = "{$host}channel/find?audience=$audience";
        $ret= HttpReq::get($query);
        return $ret;
    }

    public static function collectionsOf($id) {
        $host = Trender::api();
        $query = "{$host}channel/$id/collections";
        return HttpReq::get($query);
    }

    public static function feed($params) {
        $host=Trender::api();

        $collName = $params['collection'];
        $channelId = $params['channelId'];
        $chan = Channel::byId($channelId);
        $query="{$host}channel/{$chan->id}/feed/$collName";
        $mainCollection=HttpReq::get($query);

        $posts = $mainCollection->posts;
        $post=false;
        $video=false;

        if (!empty($posts)) {
            $idx=rand(0, count($posts)-1);
            $post=$posts[$idx];
            # cap description 
            $post->description=substr($post->description, 0, 200);

            foreach ($posts as $p) {
                if ($p->type == "youtube-post") 
                    $videos[] = $p;
            }

            if (!empty($videos)) {
                $idx = rand(0, count($videos)-1);
                $video = $videos[$idx];
            }
        }

        $sg = self::all();
        $feed = new Feed;

        $feed->loadJson([
            'channel' => $chan,
            'colls' => $chan->collections,
            'posts' => $posts,
            'featured_post' => $post,
            'featured_video' => $video,
            'active_collection' => $mainCollection,
            'sugestions' => []
        ]);

        return $feed;
    }
}
