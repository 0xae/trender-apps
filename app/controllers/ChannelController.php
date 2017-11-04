<?php
namespace app\controllers;
use app\models\Channel;

class ChannelController extends \yii\web\Controller {
    public function actionIndex() {
        $channel = Channel::find();
        return $this->render('index', [
            'channel' => $channel
        ]);
    }

}
