<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'aliases' => [
        '@img_api' => '@app/web/img/img_api',
        '@web_img_api' => '/img/img_api'
    ],
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@app/views/user'
                ],
            ],
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
        'request'      => [
            'baseUrl' => '',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => '/mainpage/default',
                'login' => '/user/security/login',
                'weather' => '/weather/default',
                'weather/view' => '/weather/default/view',
                'video' => '/video/default',
                'video/view' => '/video/default/view',
                'traffic' => '/traffic/default',
                'traffic/view' => '/traffic/default/view',
                'traffic/archive' => '/traffic/default/archive',
            ]
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => false,
        ],
    ],
    'modules' => [
        'mainpage' => [
            'class' => 'frontend\modules\mainpage\Mainpage',
        ],
        'weather' => [
            'class' => 'frontend\modules\weather\Weather',
        ],
        'video' => [
            'class' => 'frontend\modules\video\Video',
        ],
        'traffic' => [
            'class' => 'frontend\modules\traffic\Traffic',
        ],
    ],
    'params' => $params,
];
