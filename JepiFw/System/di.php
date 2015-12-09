<?php
/**
 * di.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */


return [
    \Jepi\Fw\Config\ConfigInterface::class => DI\object(\Jepi\Fw\Config\Config::class),
    \Jepi\Fw\IO\InputInterface::class => DI\object(\Jepi\Fw\IO\Input::class),
    \Jepi\Fw\IO\RequestInterface::class => DI\object(\Jepi\Fw\IO\Request::class)->lazy(),
    \Jepi\Fw\Router\RouterInterface::class => DI\object(\Jepi\Fw\Router\Router::class),
    \Jepi\Fw\Model\ModelInterface::class => DI\object(\Jepi\Fw\Model\MySqlModel::class),
    \Jepi\Fw\View\ViewInterface::class => DI\object(\Jepi\Fw\View\View::class)
];
