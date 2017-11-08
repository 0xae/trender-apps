<?php
namespace app\models;

use Yii;
use app\models\Channel;
use app\models\HttpReq;
use app\models\Utils;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\base\Model;

class Collection extends Model {
    public $id, $name, $label, $description;
    public $audience, $createdAt, $lastUpdate;
    public $channelId;

    public function rules() {
        return [
            [['label'], 'required'],
            [['id', 'channelId'], 'integer']
        ];
    }

    public function save() {
        $host = Trender::apiHost();
        $random=Yii::$app->security->generateRandomString();
        if ($this->channelId > 0) {
            $this->name = "{$this->channelId}/$random";
        } else {
            $this->name = $random;
        }

        $data = json_encode($this);
        if ($this->id > 0) {
            $url = "http://{$host}/api/collection/{$this->id}";
        } else {
            $url = "http://{$host}/api/collection/new";
        }
        $json = HttpReq::post($url, $data);
        if (!$this->id) $this->id = $json->id;
    }
}
