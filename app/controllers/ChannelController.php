<?php
namespace app\controllers;
use Yii;
use app\models\Channel;
use app\models\HttpReq;
use app\models\Utils;
use app\models\Solr;
use app\models\Feed;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;

class ChannelController extends \yii\web\Controller {
    public function actionTest() {
        $name = 'bitcoin, ethereum, ripple';
        var_dump(explode(',', $name));
    }

    public function actionNew(){
        return $this->render('save_channel', [
            'model' => new Channel
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
            return $this->redirect(['channel/watch' , 'id' => $model->id]);
        } else {
            return $this->render('save_channel', [
                'model' => $model
            ]);
        }
    }

    public function actionWatch($id=false) {
        $name = Utils::queryParam('name', false);
        if ($id) {
            $chan = Channel::byId($id);
        } else if ($name) {
            try {
                $chan = Channel::byName($name);
            } catch (NotFoundHttpException $e) {
                $fq=Utils::queryParam('fq', '');
                $o = new Channel;
                $o->name = $name;
                $o->audience = 'public';
                $o->queryConf = json_encode([
                    #q is mandatory
                    #no, i wont assuming its the same as $name
                    'q' => Utils::param('q'),
                    'fq' => explode(',', $fq)
                ]);
                $chan = $o->save();
            }
        } else {
            throw new HttpException(400, 'query param id or name are mandatory');
        }

        $queryConf = json_decode($chan->queryConf);
        $fq = explode(',', Utils::queryParam('fq', ''));
        foreach ($fq as $f) {
            $queryConf->fq[] = $f;
        }
        $feed = Feed::create($queryConf);
        $channels = Channel::all();

        return $this->render('watch',[
            'channel' => $chan,
        	'videos' => $feed['videos'],
            'posts' => $feed['posts'],
            'collections' => $feed['collections'],
            'channels' => $channels,
            'q' => $queryConf->q
        ]);
    }
}
