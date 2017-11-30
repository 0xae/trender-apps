<?php
namespace app\controllers;

use Yii;
use app\models\Channel;
use app\models\Collection;
use app\models\HttpReq;
use app\models\Utils;
use app\models\Solr;
use app\models\Feed;
use app\models\TabRender;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class ChannelController extends \yii\web\Controller {
    public function actionNew(){
        return $this->render('save_channel', [
            'model'=>new Channel
        ]);
    }

    public function actionCreate() {
        $model = new Channel;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['channel/index']);
        }
    }

    public function actionUpdate($id) {
        $model = Channel::byId($id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['channel/watch' , 'id'=>$model->id]);
        } else {
            return $this->render('save_channel', [
                'model'=>$model
            ]);
        }
    }

    public function actionWatch($id=false) {
        $name = Utils::queryParam('name', false);
        if ($id) {
            $chan = Channel::byId($id);
        } else {
            $chan = Channel::retrieve($id, $name);
        }

        $feed = $chan->feed();

        return $this->render('watch', [
            'channel' => $chan,
            'feed' => $feed
        ]);
    }

    public function actionTest() {
    }
}