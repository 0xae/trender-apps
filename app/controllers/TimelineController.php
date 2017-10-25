<?php
namespace app\controllers;
use app\models\Timeline;
use yii\web\HttpException;

class TimelineController extends \yii\web\Controller {
    public function actionSearch() {
        $q = @$_GET['q'];
        if (!$q) {
            throw new HttpException(400, "q paramater missing");
        }

        $req = Timeline::search($q);
        $timeline = $req->timeline;
        $all = Timeline::all();
        $posts = [];
        $videos = [];

        foreach ($req->posts as $p) {
             if ($p->type=='youtube-post')
                 $videos[] = $p;
             else
                 $posts[] = $p;
        }

        return $this->render('index', [
            'timeline' => $timeline,
            'timeline_list' => $all,
            'posts' => $posts,
            'videos' => $videos
        ]);
    }

    public function actionIndex($id) {
        $all = Timeline::all();
        $timeline = false;
        $posts = [];
        $videos = [];

        foreach ($all as $k) {
            if ($k->id == $id) {
                $timeline = $k;
                break;
            }
        }

        $limit = 10;
        $req = Timeline::stream($id, $limit);

        foreach($req->posts as $p) {
             if ($p->type=='youtube-post')
                 $videos[] = $p;
             else
                 $posts[] = $p;
        }

        return $this->render('index', [
            'timeline' => $timeline,
            'timeline_list' => $all,
            'posts' => $posts,
            'videos' => $videos
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

    public function actionTest() {
        return $this->render('test');
    }

    public function actionData() {
        $id = 'dummy-'.time();
$HTML = <<<HTML
<div class="dummy"  id="$id">
    <h1>This is the heading</h1>
    <p>
       <!--
        Cras justo odio, dapibus ac facilisis in, 
        egestas eget quam. Donec id elit non mi porta 
        gravida at eget metus. Nullam id dolor id 
        nibh ultricies vehicula ut id elit.
        -->
        {{ content }}
    </p>
    <a v-on:click="log(123)" href="#">read more</a>
</div>
HTML;
        header('Content-Type: application/json');
        return json_encode([
            'id' => $id,
            'html' => $HTML
        ]);
    }
}

