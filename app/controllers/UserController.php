<?php
namespace app\controllers;
use Yii;
use app\models\User;
use app\models\Login;
use yii\web\HttpException;

class UserController extends \yii\web\Controller {
    public function actionSuccess() {
        return $this->render('success');
    }

    public function actionSignup() {
        $model = new User;
        $errors = [];
        if ($model->load(Yii::$app->request->post())) {
            try {
                $model->save();
                return $this->redirect(['user/success']);
            } catch (HttpException $e) {
                $errors = $e->getMessage();
            }
        }

        return $this->render("signup", [
            "model" => $model,
            "errors" => $errors
        ]);
    }

    public function actionSignin() {
        $model = new Login;
        if ($model->load(Yii::$app->request->post())) {
            try {
                Yii::$app->user->login($model->authenticate(), 3600*24*30);
                return $this->redirect(['feed/index']);
            } catch (HttpException $e) {
                $errors = $e->getMessage();
            }
        }

        echo json_encode($errors);
    }

    public function actionSignout() {
        Yii::$app->user->logout();
        return $this->redirect(['feed/index']);
    }
}
