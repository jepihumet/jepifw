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


define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));

define('FW_ROOT', ROOT . DS . 'JepiFw');
define('APP_ROOT', FW_ROOT . DS . 'App');
define('SYSTEM_ROOT', FW_ROOT . DS . 'System');

$loader = require 'vendor/autoload.php';

$frontController = new \Jepi\Fw\FrontController\FrontController($loader);
$frontController->run();
