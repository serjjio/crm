<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager'
        ],

        'urlManager' => [
        	'class' => 'yii\web\UrlManager',
        	'showScriptName' => false,
        	'enablePrettyUrl' => true,

        	'rules' => [
                'data' => 'data/default/index',
                'data/<controller:[\w-]+>/<id:\d+>' => 'data/<controller>/view',
                'data/<controller:[\w-]+>/<action:[\w-]+>'=>'data/<controller>/<action>',
                'data/<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>'=>'data/<controller>/<action>',
                'admin' => 'admin/default/index',
                'admin/<controller:[\w-]+>/<id:\d+>' => 'admin/<controller>/view',
                'admin/<controller:[\w-]+>/<action:[\w-]+>'=>'admin/<controller>/<action>',
                'admin/<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>'=>'admin/<controller>/<action>',
                'guard' => 'guard/default/index',
                'guard/<controller:[\w-]+>/<id:\d+>' => 'guard/<controller>/view',
                'guard/<controller:[\w-]+>/<action:[\w-]+>'=>'guard/<controller>/<action>',
                'guard/<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>'=>'guard/<controller>/<action>',
                '<controller:[\w-]+>' => '<controller>/index',
        		'<controller:[\w-]+>/<id:\d+>' => '<controller>/view',
        		'<controller:[\w-]+>/<action:[\w-]+>' => '<controller>/<action>',
                '<controller:[\w-]+>/<action:[\w-]+>/<id:\d+>' => '<controller>/<action>',



        	]
        ]
    ],
];
