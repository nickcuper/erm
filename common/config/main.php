<?php

Yii::setPathOfAlias('root', realpath(__DIR__ . '/../..'));
Yii::setPathOfAlias('common', realpath(__DIR__ . '/..'));

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$config = [
    'basePath'      => __DIR__ . '/..',
    'runtimePath'   => __DIR__ . '/../../runtime',
    'extensionPath' => __DIR__ . '/../extensions',
    'name'          => 'ERM',
    'theme'         => 'adminlte',
    // preloading 'log' component
    'preload'       => ['log', 'importelastica'],
    'aliases'       => [
        'bootstrap' => 'root.vendor.drmabuse.yii-bootstrap-3-module',
    ],
    // autoloading model and component classes
    'import'        => [
        // Yii autoloaded files
        'application.models.*',
        'application.components.*',
        'bootstrap.behaviors.*',
        'bootstrap.helpers.*',
        'bootstrap.widgets.*',
    ],
    'modules'       => [
        'ESearch',
        'Memcached',
        'RMQ',
    ],
    // application components
    'components'    => [
        // elastica {{
        'importelastica' => [
            'class'   => 'application.modules.ESearch.extensions.ElasticaLoader',
            'libPath' => 'application.modules.ESearch.lib', //assume you installed Elastica to /lib/
        ],
        'elastica'       => [
            'class' => 'application.modules.ESearch.components.Elastica',
            'host'  => 'localhost',
            'port'  => '9200',
            'debug' => false
        ],
        // }}
        'amqp' => [
                'class' => 'application.modules.RMQ.components.AMQP.CAMQP',
                'host'  => '127.0.0.1'
        ],
        'bootstrap'    => [
            'class' => 'bootstrap.components.BsApi',
        ],
        'themeManager' => [
            'basePath' => __DIR__ . '/../../themes',
        ],
        'user'         => [
            'class'          => 'WebUser',
            'allowAutoLogin' => true, // enable cookie-based authentication
            'loginUrl'       => ['login'],
        ],
        'urlManager'   => [
            'showScriptName' => false,
            'urlFormat'      => 'path',
            'rules'          => [
                ''                                       => 'site/index',
                'login'                                  => 'site/login',
                'logout'                                 => 'site/logout',
                '<controller:\w+>/<id:\d+>'              => '<controller>/view',
                '<controller:\w+>/<id:\d+>/<action:\w+>' => '<controller>/<action>',
                // module Rules
                'esearch/<action:\w+>'                   => 'ESearch/default/<action>',
                'memcached/<action:\w+>'                 => 'Memcached/default/<action>',
                'rmq/<action:\w+>'                       => 'RMQ/default/<action>',
            ],
        ],
        'db'           => [
            'connectionString'      => 'mysql:host=localhost;dbname=erm',
            'emulatePrepare'        => true,
            'username'              => 'root',
            'password'              => 'root',
            'charset'               => 'utf8',
            'schemaCachingDuration' => !YII_DEBUG ? 86400 : 0,
            'enableParamLogging'    => YII_DEBUG,
        ],
        'cache'        => [
            'class'     => 'CMemCache',
            'servers'   => [
                [
                    'host'   => '127.0.0.1',
                    'port'   => 11211,
                    'weight' => 60
                ],
            ],
            'behaviors' => [
                'CacheWrapBehavior',
                'TaggingBehavior',
            ],
        ],
        'assetManager' => [
            'class'                  => 'EAssetManagerBoostGz',
            'minifiedExtensionFlags' => ['min.js', 'minified.js', 'packed.js'],
        ],
        'clientScript' => [
            'packages' => [
                'jquery'       => [ // jQuery CDN - provided by (mt) Media Temple
                    'baseUrl' => 'http://code.jquery.com/',
                    'js'      => [YII_DEBUG ? 'jquery-2.0.2.js' : 'jquery-2.0.2.min.js'],
                ],
                'bootstrap'    => [
                    'baseUrl' => '//netdna.bootstrapcdn.com/bootstrap/3.1.1/',
                    'css'     => ['css/bootstrap.min.css'], // , 'css/bootstrap-theme.min.css'
                    'js'      => ['js/bootstrap.min.js'],
                ],
                'font-awesome' => [
                    'baseUrl' => '//netdna.bootstrapcdn.com/font-awesome/4.1.0/css/',
                    'css'     => [YII_DEBUG ? 'font-awesome.css' : 'font-awesome.min.css'],
                ],
                'adminlte'     => [
                    'basePath' => 'root.themes.adminlte.assets',
                    'depends'  => ['bootstrap'],
                    'css'      => ['base.css'],
                    'js'       => ['base.js'],
                ],
            ],
        ],
        'errorHandler' => [
            // use 'site/error' action to display errors
            'errorAction' => 'site/error',
        ],
        'log'          => [
            'class'  => 'CLogRouter',
            'routes' => [
                [
                    'class'  => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ],
            ],
        ],
    ],
    'params'        => [
        // this is used in contact page
        'adminEmail' => 'webmaster@example.com',
    ],
];

// Apply local config modifications
@include dirname(__FILE__) . '/main-local.php';

return $config;
