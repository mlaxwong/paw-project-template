<?php
$config = [
    'vendorPath' => PATH_VENDOR,
    'basePath' => PATH_BASE,
    'runtimePath' => PATH_ROOT . '/runtime',
    'aliases' => [
        '@root' => PATH_ROOT,
    ],
    'modules' => [
        'public' => \project\modules\_public\Module::class,
        'admin' => \project\modules\_admin\Module::class,
    ],
    'components' => [
        'assetManager' => [
        	'linkAssets' => true,
    	],
        'errorHandler' => [
            'errorAction' => 'public/default/error',
        ],
        'request' => [
            'cookieValidationKey' => 'X6NryVcVk_UtPL41969Zg4GMmpBu-b0f',
        ],
        'urlManager' => [
            'rules' => [
                '' => 'public/default/index',
                '<action>' => 'public/default/<action>',
                '<controller>/<action>' => 'public/<controller>/<action>',
            ]
        ],
    ],
];

if (YII_DEBUG)
{
    $config = \yii\helpers\ArrayHelper::merge($config, [
        'bootstrap' => ['debug'],
        'modules' => [
            'debug' => [
                'class' => \yii\debug\Module::class
            ],
        ],
    ]);
}

return $config;