<?php

namespace Jepi\Fw\Controller;

use DI\Container;
use Jepi\Fw\Config\ConfigInterface;
use Jepi\Fw\Controller\Models;
use Jepi\Fw\Controller\Views;
use Jepi\Fw\Router\RouterInterface;
use Jepi\Fw\Storage\Session;

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
     * @var Session
     */
    protected $session;
    /**
     * @var Container
     */
    private $container;


    public function __construct(RouterInterface $router, ConfigInterface $config, Session $session, Container $container) {
        $this->router = $router;
        $this->config = $config;
        $this->session = $session;
        $this->container = $container;
    }

}
