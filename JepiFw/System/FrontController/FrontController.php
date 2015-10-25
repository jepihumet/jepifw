<?php

namespace Jepi\Fw\FrontController;

/**
 * FrontController.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class FrontController implements FrontControllerInterface {

    const DEFAULT_CONTROLLER = 'Home';
    const DEFAULT_ACTION = 'index';

    /**
     * @var Loader
     */
//    protected $loader = null;

    /**
     * @var \Jepi\Fw\Config\ConfigAbstract
     */
    protected $config = null;

    /**
     *
     * @var \Composer\Autoload\ClassLoader
     */
    protected $autoload = null;

    /**
     * @var \Jepi\Fw\Libraries\FileManager
     */
    protected $fileManager = null;
    protected $controller = null;
    protected $action = null;
    protected $params = array();
    protected $basePath = null;

    public function __construct(\Composer\Autoload\ClassLoader $autoload, array $options = array()) {
        $this->initErrorManagement();
        $this->autoload = $autoload;
        $this->fileManager = new \Jepi\Fw\Libraries\FileManager();
        $this->config = new \Jepi\Fw\Config\Config();

        $this->loadConfigFiles();
        if (empty($options)) {
            $this->parseUri();
        } else {
            if (isset($options['controller'])) {
                $this->setController($options['controller']);
            }
            if (isset($options['action'])) {
                $this->setAction($options['action']);
            }
            if (isset($options['params'])) {
                $this->setParams($options['params']);
            }
        }
    }

    private function initErrorManagement() {
        set_exception_handler(function (\Exception $e) {
            echo "Uncaught exception: " . $e->getMessage() . "\n";
        });
    }

    private function loadConfigFiles() {
        $configFiles = $this->fileManager->listAllFilesInDirectory(APP_ROOT . DS . 'config');

        foreach ($configFiles as $configFile) {
            $this->config->loadConfigFile($configFile);
        }

        $routing = $this->config->get('Routing');
        $this->basePath = $routing['basePath'];
    }

    public function parseUri() {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), DS);
        $path = preg_replace('/^[a-zA-Z0-9\/]/', '', $path);

        $path = substr($path, strlen($this->basePath));
        @list($controller, $action, $params) = explode('/', $path, 3);

        if (isset($controller) && !is_null($controller) && ($controller != "")) {
            $this->setController($controller);
        }else{
            $this->setController(SELF::DEFAULT_CONTROLLER);
        }
        if (isset($action) && !is_null($action) && ($action != "")) {
            $this->setAction($action);
        }else{
            $this->setAction(SELF::DEFAULT_ACTION);
        }
        if (isset($params) && !is_null($params) && ($params != "")) {
            $this->setParams(explode(DS, $params));
        }
    }

    public function setController($controller) {
        $controller = '\\MyApp\\Controllers\\' . ucfirst(strtolower($controller)) . 'Controller';
        if (!class_exists($controller)) {
            throw new \InvalidArgumentException("The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
        return $this;
    }

    public function setAction($action) {
        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new \InvalidArgumentException("The controller action '$action' has been not defined.");
        }
        $this->action = $action;
        return $this;
    }

    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }

    public function run() {
        try {
            call_user_func(array($this->controller, $this->action), $this->params);
        } catch (Exception $ex) {
            echo "Controller was not loaded";
        }
    }

}
