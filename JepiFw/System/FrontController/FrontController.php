<?php

namespace Jepi\Fw\FrontController;

use Composer\Autoload\ClassLoader;
use Jepi\Fw\Config\Config;
use Jepi\Fw\Config\ConfigAbstract;
use Jepi\Fw\IO\Request;
use Jepi\Fw\IO\Response;
use Jepi\Fw\Libraries\FileManager;

/**
 * FrontController.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class FrontController implements FrontControllerInterface
{
    /**
     * @var ConfigAbstract
     */
    protected $config = null;

    /**
     * @var ClassLoader
     */
    protected $autoload = null;

    /**
     * @var ContainerInterface
     */
    //protected $container = null;

    /**
     * @var RequestInterface
     */
    protected $request = null;

    public function __construct(ClassLoader $autoload,
                                array $options = array())
    {
        $this->initErrorManagement();
        $this->autoload = $autoload;
        $this->config = new Config();
        $this->loadConfigFiles();
    }

    private function initErrorManagement()
    {
        set_exception_handler(function (\Exception $e) {
            //Load Error View
            $trace = $e->getTraceAsString();
            $traceChain = nl2br($trace);
            $errorMsg = $e->getMessage();

            $message = "<h1>$errorMsg</h1><p>$traceChain</p>";

            //Create Response and send it
            $response = new Response($message, $e->getCode());
            $response->send();
        });
    }

    private function loadConfigFiles()
    {
        $fileManager = new FileManager();
        $this->config->loadFile(SYSTEM_ROOT . DS . 'config.ini');
        $configFiles = $fileManager->listAllFilesInDirectory(APP_ROOT . DS . 'Config');

        foreach ($configFiles as $configFile) {
            $this->config->loadFile($configFile);
        }
    }

    public function run()
    {
        $this->request = new Request($this->config);
        $router = $this->request->validateRequest();

        $output = call_user_func_array(array(new $router->getController(), $router->getAction()), $router->getParameters());
        $response = new Response($output, 200);
        $response->send();
    }

}
