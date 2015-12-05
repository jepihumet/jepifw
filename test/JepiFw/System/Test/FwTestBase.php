<?php

namespace Jepi\Fw\Test;
/**
 * FwTestBase.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */

class FwTestBase extends \PHPUnit_Framework_TestCase {

    /**
     * @var Container
     */
    public static $container;

    /**
     * @var FrontController
     */
    public static $frontController;

    public static function setUpBeforeClass(){
        self::$container = require __DIR__.'/../../../../bootstrap.php';
        self::$frontController = self::$container->get('\Jepi\Fw\FrontController\FrontController');
    }

}