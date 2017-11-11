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
        'static/lib/bootstrap/css/bootstrap.min.css',
        'static/css/font-awesome.min.css',
        'static/css/trender-app.css',
        'static/css/trender-feed.css',
    ];

    public $js = [
        "static/lib/require.js",
        "static/config.js",
    ];

    public $depends = [];
}
