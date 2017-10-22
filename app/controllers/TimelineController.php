<?php
namespace app\controllers;
use app\models\Timeline;

class TimelineController extends \yii\web\Controller {
    public function actionIndex($id) {
        $all = Timeline::all();
        $timeline = false;

        foreach ($all as $k) {
            if ($k->id == $id) {
                $timeline = $k;
                break;
            }
        }

        return $this->render('index', [
            'timeline' => $timeline,
            'timeline_list' => $all
        ]);
    }

    public function actionStream($id) {
        $limit = @$_GET['limit'] ? $_GET['limit'] : 10;
        $req = Timeline::stream($id, $limit);

        $posts = [];
        $videos = [];

        foreach($req->posts as $p) {
             if ($p->type=='youtube-post')
                 $videos[] = $p;
             else
                 $posts[] = $p;
        }

        $html = $this->renderPartial(
            '@app/views/plugins/stream/index', [
            'posts' => $posts
        ]);

        $html_video = $this->renderPartial(
            '@app/views/plugins/youtube_stream/index', [
            'posts' => $videos
        ]);

        return json_encode([
            'html' => $html,
            'html_video' => $html_video,
            'stream' => $req
        ]);
    }
}

