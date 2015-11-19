<?php

/**
 * Router.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Router;

use Jepi\Fw\Exceptions\RouterException;
use Jepi\Fw\Config\ConfigAbstract;
use Jepi\Fw\IO\InputInterface;

class Router implements RouterInterface {

    /**
     * @var ConfigAbstract
     */
    protected $config;

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
     * @var InputInterface
     */
    protected $inputData;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * @param ConfigAbstract $config
     * @param string $uri
     * @param InputInterface $inputData
     */
    public function __construct(ConfigAbstract $config, $uri, InputInterface $inputData) {
        $this->config = $config;

        @list($controller, $action, $params) = $this->parseUri($uri);

        jlog("URI", $uri);
        jlog("CONTROLLER", $controller);
        jlog("ACTION", $action);
        jlog("PARAMS", $params);

        $this->controller = $controller;
        $this->action = $action;
        $this->uriParams = $params;
        $this->inputData = $inputData;
        
        $this->checkController();
        $this->checkAction();
    }

    /**
     * @param $uri
     * @return array
     */
    private function parseUri($uri){
        jlog("URI", $uri);

        $path = trim(parse_url($uri, PHP_URL_PATH), DIRECTORY_SEPARATOR);
        if ($path[0] == '/'){
            $cleanPath = substr($path, 1);
        }else{
            $cleanPath = $path;
        }
        jlog("PATH", $cleanPath);
        return explode('/', $cleanPath, 3);
    }
    /**
     * 
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
     * 
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

    protected function uriDecode($uri){
        $extraParameters = explode('/', $this->uriParams);

        return;
    }
    /**
     * 
     * @param \ReflectionMethod $reflectionMethod
     * @throws RouterException
     */
    private function setParameters(\ReflectionMethod $reflectionMethod) {
        $extraParameters = $this->uriDecode($this->uriParams);

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
     * 
     * @return string
     */
    public function getController() {
        return $this->controller;
    }

    /**
     * 
     * @return string
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * 
     * @return array
     */
    public function getParameters() {
        return $this->parameters;
    }

}
