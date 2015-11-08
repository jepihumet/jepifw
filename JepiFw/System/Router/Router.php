<?php

/**
 * Router.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Router;

use Jepi\Fw\Config\ConfigAbstract;
use Jepi\Fw\IO\InputInterface;

class Router implements RouterInterface{

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
     * @param string $controller
     * @param string $action
     * @param string $params
     * @param InputInterface $inputData
     */
    public function __construct(ConfigAbstract $config, $controller, $action, $params, InputInterface $inputData){
        $this->config = $config;
        $this->controller = $controller;
        $this->action = $action;
        $this->uriParams = $params;
        $this->inputData = $inputData;

        $this->checkController();
        $this->checkAction();
    }

    private function checkController() {
        if (!isset($this->controller) || is_null($this->controller) || ($this->controller == "")) {
            $this->controller = $this->config->get('Routing', 'DefaultController');
        }
        $controllersNamespaces = $this->config->get('Namespaces', 'Controllers');
        $this->controller = $controllersNamespaces . '\\' . ucfirst(strtolower($this->controller));

        if (!class_exists($this->controller)) {
            throw new \InvalidArgumentException("The controller '{$this->controller}' has not been defined.");
        }
    }

    private function checkAction() {
        if (!isset($this->action) || is_null($this->action) || ($this->action == "")) {
            $this->action = $this->config->get('Routing', 'DefaultAction');
        }

        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($this->action)) {
            throw new \InvalidArgumentException("The controller action '{$this->action}' has been not defined.");
        }

        //Prepare to setup the input parameters
        $reflectionMethod = $reflector->getMethod($this->action);
        $this->setParameters($reflectionMethod);
    }

    private function setParameters(\ReflectionMethod $reflectionMethod) {
        //if (isset($this->parameters) && !is_null($this->parameters) && ($this->parameters != "")) {
        //    $extraParameters = explode(DIRECTORY_SEPARATOR, $this->parameters);
        //}

        $this->parameters = array();
        //Get expecting parameters
        $reflectionParameters = $reflectionMethod->getParameters();
        $unsetValue = $this->config->get('Input', 'UnsetValue');
        foreach($reflectionParameters as $reflectionParameter){
            $name = $reflectionParameter->getName();
            $value = $this->inputData->get($name);
            if ($value == $unsetValue){
                if ($reflectionParameter->isOptional()){
                    $value = $reflectionParameter->getDefaultValue();
                }else{
                    throw new RouterException("Parameter {$name} expected and not found on input data.");
                }
            }
            $this->parameters[$name] = $value;
        }
    }
}