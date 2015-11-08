<?php

/**
 * Router.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Router;

class Router implements RouterInterface{

    protected $controller;
    protected $action;
    protected $params;

    /**
     * @param string $controller
     */
    public function setController($controller) {
        $controller = $this->controllersNamespace . '\\' . ucfirst(strtolower($controller)) . 'Controller';
        if (!class_exists($controller)) {
            throw new \InvalidArgumentException("The action controller '$controller' has not been defined.");
        }
        $this->controller = $controller;
    }

    /**
     * @param string $action
     */
    public function setAction($action) {
        $reflector = new \ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new \InvalidArgumentException("The controller action '$action' has been not defined.");
        }
        $this->action = $action;
    }

    /**
     * @param array $params
     */
    public function setParameters($params) {
        $this->params = $params;
    }

    /**
     * @param string $route
     */
    public function parseRoutes($route)
    {
        // TODO: Implement parseRoutes() method.
    }

    public function validateRequest()
    {
        // TODO: Implement validateRequest() method.
    }

}