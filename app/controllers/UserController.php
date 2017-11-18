<?php
namespace app\controllers;
use Yii;
use app\models\User;

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
            } catch (Exception $e) {
                $errors = $e->getMessage();
            }
        }

        return $this->render("signup", [
            "model" => $model,
            "errors" => $errors
        ]);
    }
}
