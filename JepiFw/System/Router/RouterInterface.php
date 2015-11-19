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
     * @param $uri
     * @param InputInterface $inputData
     */
    public function __construct(ConfigAbstract $config, $uri, InputInterface $inputData);

    /**
     * 
     * @return string
     */
    public function getController();

    /**
     * 
     * @return string
     */
    public function getAction();

    /**
     * 
     * @return string
     */
    public function getParameters();
}