<?php

$approot = dirname(__FILE__);
$root = dirname(__FILE__) . '/../../..';

// include composer autoloader
require_once("$approot/../vendor/autoload.php");
require_once("$root/vendor/autoload.php");
require_once("$root/dna/vendor/autoload.php");


// Make app config available as PHP constants
require("$root/vendor/neam/php-app-config/include.php");

// include yii
require_once("$approot/../vendor/yiisoft/yii/framework/yii.php");

// config file
$config = require("$approot/config/console.php");

// This will use $config and autostart a console application
require_once("$approot/../vendor/yiisoft/yii/framework/yiic.php");
