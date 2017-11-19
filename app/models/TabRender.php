<?php
namespace app\models;
use Yii;
use yii\web\NotFoundHttpException;
use yii\web\HttpException;
use yii\base\Model;
use yii\db\ActiveRecord;
use yii\helpers\Url;

class TabRender {
    public $id;
    public $comp;
    public $active=false;
    private $lid = 1; // link id
    private $viewPath='';

    public function __construct($id) {
        if (!trim($id)) {
            throw new Exception("Invalid tabid: $id");
        }
        $this->id = $id;
        $this->default = "{$id}_default";
        $this->comp = [];
        $this->viewPath = Yii::$app->controller->id;
    }

    public function _setViewPath($v) {
        $this->viewPath = $v;
    }

    public function viewPath() {
        return $this->viewPath;
    }

    public function ajaxLink($label, $link, $active=false) {
        $default = "{$this->id}_default";
        if ($active) {
            $this->active = $default;
        }

        $url = Url::to($link);

        return "
          <a data-tab-id=\"{$this->id}\"
             data-tab-name=\"#$default\"
             data-tab-href=\"{$url}\"
             data-target=\"#$default\"
             class=\"tx-new-tab\">
             $label
           </a>
        ";
    }

    public function fileLink($label, $paneFile, $active=false, $params=[]) {    
        $obj = [
            "id" => $this->id.'_'.($this->lid++).'_tab',
            "label" => $label,
            "paneFile" => $paneFile,
            "params" => $params
        ];

        $obj["params"]["tab"] = $this;
        if ($active) {
            $this->active = $obj["id"];
        }

        $aTag="<a href=\"#{$obj['id']}\" 
               aria-controls=\"{$obj['id']}\" 
               role=\"tab\" 
               data-target=\"#{$obj['id']}\"
               data-toggle=\"tab\">
               $label
            </a>";

        $this->comp[] = $obj;
        return $aTag;
    }

    public function render() {
        return \Yii::$app->view->renderFile(
            "@app/views/plugins/tabrender/index.php",
            ["tab" => $this]
        );
    }
}