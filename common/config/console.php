<?php

$mainConfig = include dirname(__FILE__) . '/main.php';

return [
    'basePath'      => $mainConfig['basePath'],
    'runtimePath'   => $mainConfig['runtimePath'],
    'extensionPath' => $mainConfig['extensionPath'],
    'name'          => $mainConfig['name'],
    'aliases'       => $mainConfig['aliases'],
    'import'        => $mainConfig['import'],
    'preload'       => ['log'],
    'components'    => [
        'db'    => $mainConfig['components']['db'],
        'log'   => $mainConfig['components']['log'],
        'cache' => $mainConfig['components']['cache'],
        'importelastica' => [
            'class'   => 'application.modules.ESearch.extensions.ElasticaLoader',
            'libPath' => 'application.modules.ESearch.lib', //assume you installed Elastica to /lib/
        ],
        'elastica'       => [
            'class' => 'common.modules.ESearch.components.Elastica',
            'host'  => 'localhost',
            'port'  => '9200',
            'debug' => true,
        ],
       
    ],
    'modules'       => [
        'ESearch',
        'Memcached',
        'RMQ',
    ],
    'params'        => $mainConfig['params'],
];
