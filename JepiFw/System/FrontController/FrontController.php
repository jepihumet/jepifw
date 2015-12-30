<?php

namespace Jepi\Fw\FrontController;

use DI\Container;
use Jepi\Fw\Config\ConfigInterface;
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
     * @var ConfigInterface
     */
    public $config;

    /**
     * @var RequestInterface
     */
    public $request;

    /**
     * @var FileManager
     */
    private $fileManager;

    /**
     * @var Container
     */
    private $container;

    /**
     * @param ConfigInterface $config
     * @param RequestInterface $request
     * @param Container $container
     * @param FileManager $fileManager
     */
    public function __construct(ConfigInterface $config, RequestInterface $request, Container $container, FileManager $fileManager) {
        $this->config = $config;
        $this->request = $request;
        $this->container = $container;
        $this->fileManager = $fileManager;
        $this->loadConfigFiles();
        $this->initErrorManagement();
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
        $this->config->loadFile(SYSTEM_ROOT . DIRECTORY_SEPARATOR . 'config.ini');
        $configFiles = $this->fileManager->listAllFilesInDirectory(APP_ROOT . DIRECTORY_SEPARATOR . 'Config');

        foreach ($configFiles as $configFile) {
            $this->config->loadFile($configFile);
        }
    }

    /**
     * @throws \DI\NotFoundException
     */
    public function run() {
        $router = $this->request->validateRequest();

        $controller = $router->getController();
        $action = $router->getAction();
        $parameters = $router->getParameters();
        
        $output = call_user_func_array(array($this->container->get($controller), $action), $parameters);
        $response = new Renspose($output, 200);
        $response->send();
    }

    /**
     * @return RequestInterface
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig()
    {
        return $this->config;
    }

}
