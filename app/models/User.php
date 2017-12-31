<?php
namespace app\models;
use Yii;
use yii\base\Model;
use yii\web\IdentityInterface;

class User extends Model implements IdentityInterface {
    public $id;
    public $name='';
    public $email='';
    public $password='';
    public $lang='';
    public $picture='';
    public $location='';
    public $createdAt;
    public $token;

    public function rules() {
        return [
            [['name', 'email', 'password'], 'required'],
            ['name', 'filter', 'filter' => 'trim'],
            ['name', 'string', 'min' => 3],
            ['email', 'email'],
            ['id', 'integer'],
        ];
    }

    public function save() {        
        $host = Trender::api();
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'picture' => $this->picture,
        ];

        if ($this->id > 0) {
            $url = "{$host}user/{$this->id}";
            $data['id']=$this->id;
        } else {
            $url = "{$host}user/signup";
        }

        $json = HttpReq::post($url, json_encode($data));
        if (!$this->id) {
            $this->id = $json->id;
        }

        return $this;
    }

    public static function sign_in($login) {
        $host = Trender::api();
        $data = json_encode($login);
        $url = "{$host}user/signin";
        $resp = HttpReq::post($url, $data);

        $json = $resp->user;
        $token = "{$resp->prefix} {$resp->token}";
        return self::convert_to($json, $token);
    }

    private static function convert_to($json, $token=false) {
        $u = new User;
        $u->id=$json->id;
        $u->name=$json->name;
        $u->email=$json->email;
        $u->lang=$json->lang;
        $u->picture=$json->picture;
        $u->location=$json->location;
        $u->createdAt=$json->createdAt;
        if ($token) $u->token=$token;
        return $u;
    }

    public static function findIdentity($id) {
        $host = Trender::api();
        $url = "{$host}user/{$id}";
        $resp = HttpReq::get($url);
        return self::convert_to($resp);
    }

    public static function findIdentityByAccessToken($token, $type = null) {
        $host = Trender::api();
        $url = "{$host}user/me";
        $resp = HttpReq::get($url, ["Authorizarion: $token"]);
        return $resp->user;
    }

    public function getId() {
        return $this->id;
    }

    public function getAuthKey() {
        return $this->token;
    }

    public function validateAuthKey($authKey) {
        return true;
    }
}
