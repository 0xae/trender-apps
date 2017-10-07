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
        "static/lib/jquery/jquery-2.1.4.min.js",
        "static/lib/lodash/lodash.js",
        "static/lib/moment/moment.min.js",
        "static/lib/vuew/vue.js",
        "static/app/app.js",
        "static/app/timeline.js",
        "static/app/components.js",
    ];

    public $depends = [
    ];
}
