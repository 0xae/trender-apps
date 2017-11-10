<?php
namespace app\controllers;

class CollectionController extends \yii\web\Controller {
    public function actionCreate() {
        return $this->render('index');
    }

    public function actionCreate() {
        $model = new Channel;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['collection/index']);
        }
    }
}
