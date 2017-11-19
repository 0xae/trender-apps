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
        $feed = Feed::ofChannel($id);
        $chan = $feed['channel'];
        $sugests = Channel::find();

        return $this->render('watch', [
            'channel' => $chan,
            'sugests' => $sugests,
            'featuredPost' => $feed['featuredPost'],
            'q' => $chan->json('queryConf')->q
        ]);
    }

    public function actionView_collection($id) {
        $coll = Collection::byId($id);
        $channel = Channel::byId($coll->channelId);
        echo $this->renderPartial('tab.render/watch/view_collection', [
            'model' => $coll,
            'channel' => $channel
        ]);
    }


    public function actionTest() {
    }
}