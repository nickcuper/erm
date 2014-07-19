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
       
    ],
    'params'        => $mainConfig['params'],
];
