<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AdminoxAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'themes/adminox200/assets/libs/lightbox2/lightbox.min.css',
        //'themes/adminox200/assets/css/bootstrap.css', //comment out as already configured in config/main.php (in assetManager)
        'themes/adminox200/assets/css/icons.css',
        'themes/adminox200/assets/css/app.css',
        'css/my-site.css',
        //'css/site.css',
    ];
    public $js = [
        'themes/adminox200/assets/libs/d3/d3.min.js',
        'themes/adminox200/assets/libs/c3/c3.min.js',
        'themes/adminox200/assets/libs/echarts/echarts.min.js',
        'themes/adminox200/assets/js/pages/dashboard.init.js',

        //'themes/adminox200/assets/js/vendor.js', //cannot use vendor.js because it is contains jquery and bootstrap script
        'themes/adminox200/assets/js/vendor/jquery.counterup.min.js',
        'themes/adminox200/assets/js/vendor/jquery.slimscroll.js',
        'themes/adminox200/assets/js/vendor/jquery.waypoints.min.js',
        'themes/adminox200/assets/js/vendor/metisMenu.js',
        'themes/adminox200/assets/js/vendor/waves.js',
        'themes/adminox200/assets/libs/lightbox2/lightbox.min.js',
        'themes/adminox200/assets/js/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
