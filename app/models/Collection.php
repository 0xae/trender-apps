<?php
namespace app\models;
use Yii;
use app\models\Channel;
use app\models\HttpReq;
use app\models\Utils;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\base\Model;
use yii\db\ActiveRecord;

class Collection extends Model {
    public $id, $name, $label, $description;
    public $audience, $createdAt, $lastUpdate;
    public $channelId;

    public function Collection() {
    }

    public function rules() {
        return [
            [['label', 'label', 'audience', 'name'], 'required'],
            [['id', 'channelId'], 'integer']
        ];
    }

    public function save() {
        $host=Trender::api();
        if ($this->name !="") {
            $random=Yii::$app->security->generateRandomString();
            $this->name = "$random";
            if ($this->channelId > 0)
                $this->name = "{$this->channelId}/{$this->name}";
        }

        $data = json_encode($this);
        if ($this->id > 0) {
            $url = "{$host}collection/{$this->id}";
        } else {
            $url = "{$host}collection/new";
        }

        $json = HttpReq::post($url, $data);
        if (!$this->id) 
            $this->id = $json->id;
    }
}
