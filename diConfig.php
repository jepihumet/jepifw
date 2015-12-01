<?php
/**
 * diConfig.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */


return [
    \Jepi\Fw\Config\ConfigInterface::class => DI\object(\Jepi\Fw\Config\Config::class),
    \Jepi\Fw\Config\ConfigAbstract::class => DI\object(\Jepi\Fw\Config\Config::class),
    \Jepi\Fw\Controller\ControllerInterface::class => DI\object(\Jepi\Fw\Controller\Controller::class),
    \Jepi\Fw\FrontController\FrontControllerInterface::class => DI\object(\Jepi\Fw\FrontController\FrontController::class),
    \Jepi\Fw\IO\InputInterface::class => DI\object(\Jepi\Fw\IO\Input::class),
    \Jepi\Fw\IO\RequestInterface::class => DI\object(\Jepi\Fw\IO\Request::class)->lazy(),
    \Jepi\Fw\IO\Response::class => DI\object(\Jepi\Fw\IO\Response::class),
    \Jepi\Fw\Router\RouterInterface::class => DI\object(\Jepi\Fw\Router\Router::class),
    \Jepi\Fw\Controller\ControllerInterface::class => DI\object(\Jepi\Fw\Controller\Controller::class)
];