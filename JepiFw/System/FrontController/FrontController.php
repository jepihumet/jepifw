<?php

namespace Jepi\Fw\FrontController;

use Composer\Autoload\ClassLoader;
use Jepi\Fw\Config\ConfigAbstract;
use Jepi\Fw\IO\Request;
use Jepi\Fw\IO\RequestInterface;
use Jepi\Fw\IO\Response;
use Jepi\Fw\Libraries\FileManager;

/**
 * FrontController.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class FrontController implements FrontControllerInterface {

    /**
     * @var ConfigAbstract
     */
    protected $config = null;

    /**
     * @var ClassLoader
     */
    protected $autoload = null;

    /**
     * @var RequestInterface
     */
    protected $request = null;

    public function __construct(ClassLoader $autoload, ConfigAbstract $config, Request $request) {
        $this->initErrorManagement();
        $this->autoload = $autoload;
        $this->config = $config;
        $this->request = $request;
        $this->loadConfigFiles();
    }

    private function initErrorManagement() {
        set_exception_handler(function (\Exception $e) {
            //Load Error View
            $trace = $e->getTraceAsString();
            $trace = nl2br($trace);
            $errorMsg = $e->getMessage();
            $implements = class_implements($e);
            if (in_array('JepiException', $implements)){
                $errorType = $e->getExceptionType();
            }else{
                $errorType = 'PHP Error';
            }
            $errorCode = $e->getCode();
            if ($errorCode == -1){
                $errorCode = 500;
            }

            $content = sprintf('<h2>Error %s: %s</h2><p>%s</p></br>%s', $errorCode, $errorType, $errorMsg, $trace);

            //Create Response and send it
            $response = new Response($content, $e->getCode());
            $response->send();
        });
    }

    private function loadConfigFiles() {
        $fileManager = new FileManager();
        $this->config->loadFile(SYSTEM_ROOT . DS . 'config.ini');
        $configFiles = $fileManager->listAllFilesInDirectory(APP_ROOT . DS . 'Config');

        foreach ($configFiles as $configFile) {
            $this->config->loadFile($configFile);
        }
    }

    public function run() {
        $router = $this->request->validateRequest();

        $controller = $router->getController();
        $action = $router->getAction();
        $parameters = $router->getParameters();
        
        $output = call_user_func_array(array(new $controller, $action), $parameters);
        $response = new Response($output, 200);
        $response->send();
    }

}
