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
    const DEFAULT_CONTROLLER    = "IndexController";
    const DEFAULT_ACTION        = "index";

    protected $controller       = self::DEFAULT_CONTROLLER;
    protected $action           = self::DEFAULT_ACTION;
    protected $params           = array();
    protected $basePath         = "mybasepath/";

    public function __construct(array $options = array()){
        if (empty($options)){
            $this->parseUri();
        }else{
            if (isset($options['controller'])){
                $this->setController($options['controller']);
            }
            if (isset($options['action'])){
                $this->setAction($options['action']);
            }
            if (isset($options['params'])){
                $this->setParams($options['params']);
            }
        }
    }

    public function parseUri(){
        $path = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH),'/');
        $path = preg_replace('/[^a-zA-Z0-9]//','',$path);

        if (strpos($path, $this->basePath) === 0){
            $path = substr($path, strlen($this->basePath));
        }

        @list($controller, $action, $params) = explode('/', $path, 3);
        if (isset($controller)){
            $this->setController($controller);
        }
        if (isset($action)){
            $this->setAction($action);
        }
        if (isset($params)){
            $this->setParams(explode('/',$params));
        }
    }
    public function setController($controller)
    {
        $controller = ucfirst(strtolower($controller)).'Controller';
        if (!class_Exists($controller)){
            throw new InvalidArgumentException("The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
        return $this;
    }

    public function setAction($action)
    {
        $reflector = new ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)){
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