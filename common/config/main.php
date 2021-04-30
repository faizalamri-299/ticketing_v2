<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Asia/Kuala_Lumpur',
            'timeZone' => 'Asia/Kuala_Lumpur',
            'thousandSeparator' => ',',
            'decimalSeparator' => '.',
            'currencyCode' => 'RM ',
            'nullDisplay' => '',
            'dateFormat' => 'dd MMM Y',
        ],
        'assetManager' => [
            'appendTimestamp' => true,
            'bundles' => [
                'yii\bootstrap4\BootstrapAsset' => [
                    'sourcePath' => 'themes/adminox200/assets/',
                    'css' =>
                       ['css/bootstrap.css'],
                       //['css/bootstrap-dark.css'], //dark-mode
                ],
                'yii\web\JqueryAsset' => [
                    'sourcePath' => 'themes/adminox200/assets/',
                    'js' =>                    
                      ['js/vendor/jquery.js'],
                ],
            ],
        ],
    ],  
];
