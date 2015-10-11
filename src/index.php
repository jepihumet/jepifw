<?php
/**
 * index.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

require_once ROOT . "/system/library/Loader/DIContainer.php";
$autoloader = new DIContainer();

$frontController = new FrontController();
$frontController->run();