<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CalendarAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.css',
        'css/calendar_custom.css',
    ];
    public $js = [
        'https://unpkg.com/js-year-calendar@latest/dist/js-year-calendar.min.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}