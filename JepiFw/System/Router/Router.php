<?php

/**
 * Router.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Router;

use Jepi\Fw\Config\ConfigInterface;
use Jepi\Fw\Exceptions\RouterException;
use Jepi\Fw\IO\InputInterface;

class Router implements RouterInterface {

    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var InputInterface
     */
    protected $inputData;

    /**
     * @var string
     */
    protected $controller;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string
     */
    protected $uriParams;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @param ConfigInterface $config
     * @param InputInterface $inputData
     * @throws RouterException
     */
    public function __construct(ConfigInterface $config, InputInterface $inputData) {
        $this->config = $config;
        $this->inputData = $inputData;
    }

    /**
     * @param string $uri
     * @throws RouterException
     */
    public function checkRoute($uri){
        @list($controller, $action, $params) = $this->parseUri($uri);

        $this->controller = $controller;
        $this->action = $action;
        $this->uriParams = $params;

        $this->checkController();
        $this->checkAction();
    }

    /**
     * @param $uri
     * @return array
     */
    private function parseUri($uri){
        $path = trim(parse_url($uri, PHP_URL_PATH), DIRECTORY_SEPARATOR);
        if ($path[0] == '/'){
            $cleanPath = substr($path, 1);
        }else{
            $cleanPath = $path;
        }
        return explode('/', $cleanPath, 3);
    }

    /**
     * @throws RouterException
     */
    private function checkController() {
        if (!isset($this->controller) || is_null($this->controller) || ($this->controller
                == "")) {
            $this->controller = $this->config->get('Routing',
                    'DefaultController');
        }
        $controllersNamespaces = $this->config->get('Namespaces', 'Controllers');
        $this->controller = $controllersNamespaces . '\\' . ucfirst(strtolower($this->controller));

        if (!class_exists($this->controller)) {
            throw new RouterException("The controller '{$this->controller}' has not been defined.");
        }
    }

    /**
     * @throws RouterException
     */
    private function checkAction() {
        if (!isset($this->action) || is_null($this->action) || ($this->action == "")) {
            $this->action = $this->config->get('Routing', 'DefaultAction');
        }
        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($this->action)) {
            throw new RouterException("The controller action '{$this->action}' has been not defined.");
        }

        //Prepare to setup the input parameters
        $reflectionMethod = $reflector->getMethod($this->action);
        $this->setParameters($reflectionMethod);
    }

    /**
     * @param \ReflectionMethod $reflectionMethod
     * @throws RouterException
     */
    private function setParameters(\ReflectionMethod $reflectionMethod) {
        $this->parameters = array();
        //Get expecting parameters
        $reflectionParameters = $reflectionMethod->getParameters();
        $unsetValue = $this->config->get('Input', 'UnsetValue');
        foreach ($reflectionParameters as $reflectionParameter) {
            $name = $reflectionParameter->getName();
            $value = $this->inputData->get($name);
            if ($value == $unsetValue) {
                if ($reflectionParameter->isDefaultValueAvailable()) {
                    $value = $reflectionParameter->getDefaultValue();
                } else {
                    throw new RouterException("Parameter '{$name}' expected and not found on input data.");
                }
            }
            $this->parameters[$name] = $value;
        }
    }

    /**
     * @return string
     */
    public function getController() {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * @return array
     */
    public function getParameters() {
        return $this->parameters;
    }

}
