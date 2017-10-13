<?php
namespace app\assets;
use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle {
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/css/site.css',
        'static/css/font-awesome.min.css',
    ];

    public $js = [
        "static/lib/bootstrap/js/bootstrap.min.js",
        "static/app/config.js",
        "static/app/app.js",
        "static/app/components/builtin.js",
        "static/app/components/timeline/component.js",
        "static/app/components/timeline/service.js",
        "static/app/components/timeline/controller.js"
    ];

    public $depends = [
    ];
}
