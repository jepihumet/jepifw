<?php

/**
 * RouterInterface.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

namespace Jepi\Fw\Router;


use Jepi\Fw\Config\ConfigInterface;
use Jepi\Fw\IO\InputInterface;

interface RouterInterface
{
    /**
     * @param ConfigInterface $config
     */
    public function __construct(ConfigInterface $config);

    /**
     * 
     * @param InputInterface $inputData
     */
    public function setInput(InputInterface $inputData);
    
    /**
     * @param $uri
     */
    public function checkRoute($uri);
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