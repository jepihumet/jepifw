<?php
/**
 * bootstrap.php
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

$loader = require __DIR__.'/vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder;
$containerBuilder->addDefinitions(SYSTEM_ROOT.'/di.php');
$containerBuilder->useAnnotations(true);
$container = $containerBuilder->build();

return $container;