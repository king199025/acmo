<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css',
        'css/libs.min.css',
        'css/styles.min.css',
        'css/map.css',
        //'css/site.min.css',
    ];
    public $js = [
        'js/jquery-3.2.1.min.js',
        'js/script.min.js',
        'js/ajax.js',
        '//api-maps.yandex.ru/2.1/?lang=ru-RU',
        'js/map/ACMap.js',
        'js/map/map.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
