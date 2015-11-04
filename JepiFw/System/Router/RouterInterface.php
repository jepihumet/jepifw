<?php

/**
 * RouterInterface.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Router;


interface RouterInterface
{
    public function setController($controller);
    public function setAction($action);
    public function setParameters($parameters);
    public function parseRoutes();
    public function validateRequest();
}