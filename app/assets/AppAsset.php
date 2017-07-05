<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

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
        "static/lib/lodash/lodash.js",
        "static/lib/moment/moment.min.js",
        "static/lib/moment-duration-format/moment-duration-format.js",
        "static/lib/angularjs/angular.min.js",
        "static/app/app.js",
        "static/app/controllers/post.js",
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
