<?php
namespace app\models;

use Yii;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\helpers\Html;
use app\models\Channel;
use app\models\DateUtils;
use app\models\HttpReq;
use app\models\Solr;
use app\models\Utils;

class Feed {
    public $featured_post = false;
    public $featured_video = false;
    public $colls = [];

    public function loadJson($json) {
        foreach ($json as $key => $value) {
            $this->{$key} = $value;
        }
    }
}
