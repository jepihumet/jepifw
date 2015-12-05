<?php

namespace Jepi\Fw\Controller;

use DI\Container;
use Jepi\Fw\Config\ConfigInterface;
use Jepi\Fw\Controller\Models;
use Jepi\Fw\Controller\Views;
use Jepi\Fw\Router\RouterInterface;

/**
 * Controller.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class Controller implements ControllerInterface {

    /**
     * @var RouterInterface
     */
    protected $router;
    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var Container
     */
    private $container;


    public function __construct(RouterInterface $router, ConfigInterface $config, Container $container) {
        $this->router = $router;
        $this->config = $config;
    }

}
