<?php
namespace app\controllers;
use app\models\Timeline;
use app\models\Log;

class TimelineController extends \yii\web\Controller {
    public function actionIndex($id) {
        $limit = @$_GET['limit'] ? $_GET['limit'] : 50;
        $all = Timeline::all();
        $start = false;
        foreach ($all as $k) {
            if ($k->id == $id) {
                // retrieve the last N
                $index = (int)$k->index;
                $start = max(0, $index - 50);
                break;
            }
        }

        $req = Timeline::stream($id, $limit, $start);
        $posts = [];
        $videos = [];

        foreach($req->posts as $p) {
            if ($p->type=='youtube-post')
                $videos[] = $p;
            else
                $posts[] = $p;
        }

        return $this->render('index', [
            'timeline' => $req->timeline,
            'timeline_list' => $all,
            'posts' => $posts,
            'videos' => $videos
        ]);
    }

    public function actionStream($id) {
        $limit = @$_GET['limit'] ? $_GET['limit'] : 10;
        $req = Timeline::stream($id, $limit);
        $html = $this->renderPartial('stream', [
            'posts' => $req->posts
        ]);

        $posts = [];
        $videos = [];

        foreach($req->posts as $p) {
            if ($p->type=='youtube-post')
                $videos[] = $p;
            else
                $posts[] = $p;
        }

        return json_encode([
            'html' => $html,
            'stream' => $req
        ]);
    }
}

