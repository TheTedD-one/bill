<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/icons/icomoon/styles.css',
        'css/core/bootstrap.min.css',
        'css/core/core.min.css',
        'css/core/components.min.css',
        'css/core/colors.min.css',
    ];
    public $js = [
        'js/plugins/pace.min.js',
        'js/core/bootstrap.min.js',
        'js/plugins/blockui.min.js',
        'js/core/app.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
    ];
}
