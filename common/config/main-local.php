<?php

$config['modules']['gii'] = [
	'class'=>'system.gii.GiiModule',
	'password' => false,
	// If removed, Gii defaults to localhost only. Edit carefully to taste.
	'ipFilters'=>['127.0.0.1','::1'],
    'generatorPaths' => ['bootstrap.gii'],
];

$group = &$config['components']['db'];
$group = array_merge($group, [
	'connectionString' => 'mysql:host=localhost;dbname=erm',
	'username' => 'root',
	'password' => 'root',
]);

// yiidebugtb

$config['components']['log']['routes'][] = [
    'class'=>'XWebDebugRouter',
    'config'=>'alignLeft, opaque, runInDebug, fixedPos, collapsed, yamlStyle',
    'levels'=>'error, warning, trace, profile, info',
    'allowedIPs'=>['127.0.0.1','::1'],
];


