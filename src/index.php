<?php
/**
 * index.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));


require_once ROOT . DS . 'system' . DS . 'config' . DS . 'ConfigAbstract.php';
require_once ROOT . DS . 'system' . DS . 'config' . DS . 'Config.php';

require_once ROOT . DS . 'system' . DS . 'core' . DS . 'JepiException.php';

require_once ROOT . DS . 'system' . DS . 'library' . DS . 'DirectoryManager' . DS . 'DirectoryManagerInterface.php';
require_once ROOT . DS . 'system' . DS . 'library' . DS . 'DirectoryManager' . DS . 'DirectoryManager.php';

require_once ROOT . DS . 'system' . DS . 'core' . DS . 'AutoLoader' . DS . 'AutoLoaderException.php';
require_once ROOT . DS . 'system' . DS . 'core' . DS . 'AutoLoader' . DS . 'AutoLoaderInterface.php';
require_once ROOT . DS . 'system' . DS . 'core' . DS . 'AutoLoader' . DS . 'AutoLoader.php';
require_once ROOT . DS . 'system' . DS . 'core' . DS . 'AutoLoader' . DS . 'AutoLoaderPath.php';

require_once ROOT . DS . 'system' . DS . 'core' . DS . 'Loader' . DS . 'Loader.php';

require_once ROOT . DS . 'system' . DS . 'core' . DS . 'FrontController' . DS . 'FrontControllerInterface.php';
require_once ROOT . DS . 'system' . DS . 'core' . DS . 'FrontController' . DS . 'FrontController.php';

$frontController = new FrontController();
$frontController->run();
