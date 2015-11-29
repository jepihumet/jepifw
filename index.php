<?php

/**
 * index.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
error_reporting(E_ALL);
ini_set("display_errors", 1);
date_default_timezone_set('UTC');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

define('FW_ROOT', ROOT . DS . 'JepiFw');
define('APP_ROOT', FW_ROOT . DS . 'App');
define('SYSTEM_ROOT', FW_ROOT . DS . 'System');

function jlog($key, $value){
    echo "$key => ".json_encode($value)."<br>";
}

$loader = require 'vendor/autoload.php';

\Jepi\Fw\DependencyInjection\DI::addClass('Composer\Autoload\ClassLoader', $loader);
$frontController = \Jepi\Fw\DependencyInjection\DI::get('\Jepi\Fw\FrontController\FrontController');
$frontController->run();
