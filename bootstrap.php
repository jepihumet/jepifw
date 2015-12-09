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

if (!defined('ROOT')) {
    define('ROOT', dirname(__FILE__));

    define('FW_ROOT', ROOT . DIRECTORY_SEPARATOR . 'JepiFw');
    define('APP_ROOT', FW_ROOT . DIRECTORY_SEPARATOR . 'App');
    define('SYSTEM_ROOT', FW_ROOT . DIRECTORY_SEPARATOR . 'System');
}
$loader = require __DIR__.'/vendor/autoload.php';

$containerBuilder = new \DI\ContainerBuilder;
$containerBuilder->addDefinitions(SYSTEM_ROOT.'/di.php');
$containerBuilder->useAnnotations(true);
$container = $containerBuilder->build();

return $container;