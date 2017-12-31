<?php
namespace app\models;
use yii\base\Model;
use yii\web\IdentityInterface;

class Login extends Model {
    public $email;
    public $password;

    public function rules() {
        return [
            [['email', 'password'], 'required'],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['password', 'string', 'min' => 7]
        ];
    }

    public function authenticate() {
        return User::sign_in($this);
    }
}
