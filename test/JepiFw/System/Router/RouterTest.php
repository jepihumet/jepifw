<?php

namespace Jepi\Fw\Router;
use Jepi\Fw\IO\Input;
use Jepi\Fw\Test\FwTestBase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-11-08 at 23:00:53.
 */
class RouterTest extends FwTestBase {

    /**
     * @var Router
     */
    protected static $object;


    public static function setUpBeforeClass() {
        parent::setUpBeforeClass();

        $input = new Input();
        $input->setup(array('param1' => 1, 'param2' => 2),false);

        self::$object = new Router(self::$frontController->getConfig(), $input);
        self::$object->checkRoute('/demo/testmethod');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {

    }

    /**
     * @covers Jepi\Fw\Router\Router::getController
     */
    public function testGetController(){
        $this->assertEquals("\\App\\Controllers\\Demo",self::$object->getController());
    }

    /**
     * @covers Jepi\Fw\Router\Router::getAction
     */
    public function testGetAction(){
        $this->assertEquals("testmethod", self::$object->getAction());
    }

    /**
     * @covers Jepi\Fw\Router\Router::getParameters
     */
    public function testGetParameters(){
        $parameters = self::$object->getParameters();
        $this->assertArrayHasKey("param1", $parameters);
        $this->assertArrayHasKey("param2", $parameters);
    }
}
