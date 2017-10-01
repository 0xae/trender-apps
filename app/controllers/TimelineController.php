<?php
namespace app\controllers;
use app\models\Timeline;

class TimelineController extends \yii\web\Controller {
    public function actionIndex($id) {
        $limit = @$_GET['limit'] ? $_GET['limit'] : 50;
        $req = Timeline::stream($id, $limit);
        return $this->render('index', [
            'timeline' => $req->timeline,
            'posts' => $req->posts
        ]);
    }

    public function actionStream($id) {
        $limit = @$_GET['limit'] ? $_GET['limit'] : 10;
        $req = Timeline::stream($id, $limit);
        $html = $this->renderPartial('stream', [
            'posts' => $req->posts
        ]);

        return json_encode([
            'html' => $html,
            'stream' => $req
        ]);
    }
}

