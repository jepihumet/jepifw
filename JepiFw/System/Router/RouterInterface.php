<?php

/**
 * RouterInterface.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Router;


use Jepi\Fw\Config\ConfigAbstract;
use Jepi\Fw\IO\InputInterface;

interface RouterInterface
{
    /**
     * @param ConfigAbstract $config
     * @param string $controller
     * @param string $action
     * @param string $params
     * @param InputInterface $inputData
     */
    public function __construct(ConfigAbstract $config, $controller, $action, $params, InputInterface $inputData);

    public function getController();

    public function getAction();

    public function getParameters();
}