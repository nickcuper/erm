<?php
date_default_timezone_set('America/Los_Angeles');

defined('YII_DEBUG') or define('YII_DEBUG', true);
// Debug is on when remote address is localhost
defined('YII_DEBUG') or $_SERVER['REMOTE_ADDR'] === '127.0.0.1' and define('YII_DEBUG', true);
defined('YII_DEBUG') or $_SERVER['REMOTE_ADDR'] === '::1' and define('YII_DEBUG', true);

ini_set('display_errors',         YII_DEBUG ? 1 : 0);
ini_set('display_startup_errors', YII_DEBUG ? 1 : 0);
error_reporting(YII_DEBUG ? -1 : 0);

// change the following paths if necessary
$yii    = dirname(__FILE__) . '/../../vendor/yiisoft/yii/framework/' . (YII_DEBUG ? 'yii.php' : 'yiilite.php');
$yii    = dirname(__FILE__) . '/../../vendor/yiisoft/yii/framework/yii.php'; // Remove this line when there is yii 1.1.15
$config = dirname(__FILE__) . '/../config/main.php';

// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once(dirname(__FILE__) . '/../../vendor/autoload.php');

require_once($yii);
Yii::createWebApplication($config)->run();
