<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name' => 'YKTLJ - Pentadbiran',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
        'class' => 'yii\web\UrlManager',
        // Disable index.php
        'showScriptName' => false,
        // Disable r= routes
        'enablePrettyUrl' => true,
        'rules' =>[
            '<controller:\w+>/<id:\d+>' => '<controller>/view',
            '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
            '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],

    ],
    'modules' => [
        'pentadbiran' => [
            'class' => 'frontend\modules\pentadbiran\Module',
        ],

         'audit' => [ 'class' => 'bedezign\yii2\audit\Audit',
            'accessRoles' => ['super_admin'],
            'ignoreActions' => ['audit/*', 'debug/*'],
            'db' => 'db_audit',
        ],

        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
        ], 

        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],

         'datecontrol' =>  [
            'class' => '\kartik\datecontrol\Module',
            'displaySettings' => [
            'date' => 'dd-MM-yyyy',
            'time' => 'H:i:s A',
            'datetime' => 'dd-MM-yyyy H:i:s A',
        ],

        // format settings for saving each date attribute
        'saveSettings' => [
            'date' => 'dd-MM-yyyy', 
            'time' => 'H:i:s',
            'datetime' => 'dd-MM-yyyy H:i:s',
        ],

        // automatically use kartik\widgets for each of the above formats
        'autoWidget' => true,

        ],#ending datecontrol
    ], #ending modules
    'params' => $params,
];
