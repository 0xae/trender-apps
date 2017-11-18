<?php
namespace app\models;
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

    /**
     * @inheritdoc
     */
    public static function findIdentity($id) {
        return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username) {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password) {
        return $this->password === $password;
    }
}
