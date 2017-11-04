<?php
namespace app\controllers;
use Yii;
use app\models\Channel;
use app\models\HttpReq;

class ChannelController extends \yii\web\Controller {
    public function actionTest() {
        $url = "http://127.0.0.1:5000/api/channeil";
        var_dump(HttpReq::get($url));
    }

    public function actionCreate() {
        $model = new Channel;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['channel/index']);
        }
    }

    public function actionUpdate($id) {
        $model = new Channel;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['channel/index']);
        } else {
            return $this->render('save_channel', [
                'model' => $model
            ]);
        }
    }

    public function actionIndex() {
        return $this->redirect(['channel/public']);
    }

    public function actionNew(){
        return $this->render('save_channel', [
            'model' => new Channel
        ]);
    }

    public function actionPrivate(){
        return $this->render('list_channel', [
            'data' => Channel::find('private'),
            'audience'=> 'private'
        ]);
    }

    public function actionPublic(){
        return $this->render('list_channel', [
            'data' => Channel::find(),
            'audience'=> 'public'
        ]);
    }

    public function actionTimeline(){
        return $this->render('timeline_channel', [
            'data' => []
        ]);
    }

    public function actionRecent(){
        return $this->render('recent_channel', [
        ]);
    }

    public function actionActivity(){
        return $this->render('activity_channel', [
        ]);
    }

    public function actionStatistics(){
        return $this->render('statistics_channel', [
        ]);
    }
}
