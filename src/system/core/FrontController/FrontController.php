<?php

/**
 * FrontController.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class FrontController implements FrontControllerInterface
{
    const DEFAULT_CONTROLLER = "HomeController";
    const DEFAULT_ACTION = "index";

    /**
     * @var Loader
     */
    protected $loader = null;

    /**
     * @var ConfigAbstract
     */
    protected $config = null;

    /**
     * @var DirectoryManager
     */
    protected $directoryManager = null;

    protected $controller = self::DEFAULT_CONTROLLER;
    protected $action = self::DEFAULT_ACTION;
    protected $params = array();
    protected $basePath = null;

    public function __construct(array $options = array())
    {
        $this->initializeDirectoryManager();
        $this->initializeConfig();
        $this->initializeAutoLoader();
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

    public function initializeDirectoryManager()
    {
        $this->directoryManager = new DirectoryManager();
    }

    public function initializeConfig()
    {
        $this->config = new Config();
        $configFiles = $this->directoryManager->listAllFilesInDirectory(ROOT . DS . 'application' . DS . 'config');
        foreach ($configFiles as $configFile) {
            $this->config->loadConfigFile($configFile);
        }
        $this->basePath = $this->config->get('basePath');
    }

    public function initializeAutoLoader()
    {
        $autoLoader = new AutoLoader($this->directoryManager);
        $this->loader = new Loader($autoLoader);
    }

    public function parseUri()
    {
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), DS);
        //$path = preg_replace('/[^a-zA-Z0-9]/', '', $path);

        $path = substr($path, strlen($this->basePath));
        @list($controller, $action, $params) = explode('/', $path, 3);

        if (isset($controller) && $controller != "") {
            $this->setController($controller);
        }
        if (isset($action) && $action != "") {
            $this->setAction($action);
        }
        if (isset($params) && $params != "") {
            $this->setParams(explode(DS, $params));
        }
    }

    public function setController($controller)
    {
        $controller = ucfirst(strtolower($controller)) . 'Controller';
        if (!class_exists($controller)) {
            throw new InvalidArgumentException("The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
        return $this;
    }

    public function setAction($action)
    {
        $reflector = new ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new InvalidArgumentException("The controller action '$action' has been not defined.");
        }
        $this->action = $action;
        return $this;
    }

    public function setParams(array $params)
    {
        $this->params = $params;
        return $this;
    }

    public function run()
    {
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }

}