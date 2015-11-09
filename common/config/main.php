<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => true,
            'rules' => [
                '/' => 'site/index',
                'about' => 'site/about',
                'contact' => 'site/contact',
                'catcha' => 'site/captcha',
                'login' => 'site/login',
                'logout' => 'site/logout',
                'signup' => 'site/signup',
                'routes' => 'routes/index',
                'routes/view' => 'routes/view',
                'routes/create' => 'routes/create',
                'routes/update' => 'routes/update',
                'routes/delete' => 'routes/delete',
                'routes/create-url' => 'routes/create-url',
                'catchAll' => ['class' => 'common\components\CustomUrlRule'],

            ],
        ],

    ],
];
