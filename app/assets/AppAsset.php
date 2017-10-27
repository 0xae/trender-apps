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
        "static/lib/require.js",
        "static/config.js",
    ];

    public $depends = [];
}
