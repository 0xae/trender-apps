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
        /*
        "static/lib/jquery/jquery-2.1.4.min.js",
        "static/lib/vuew/vue.js",
        "static/lib/angular.min.js",
        "static/lib/lodash/lodash.js",
        */
        "static/app/config.js",
        "static/app/app.js",
        /*
        "static/app/components/builtin.js",
        "static/app/components/timeline/component.js",
        "static/app/components/timeline/service.js",
        "static/app/components/timeline/controller.js",
        */
    ];

    public $depends = [
    ];
}
