<?php

namespace Jepi\Fw\View;
use Jepi\Fw\Test\FwTestBase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-12-10 at 23:28:30.
 */
class ViewTest extends FwTestBase {

    /**
     * @var View
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = self::$container->get('Jepi\Fw\View\View');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Jepi\Fw\View\View::addVar
     */
    public function testAddVar() {
        $this->object->addVar('content', 'hola');
        $vars = $this->object->getVars();
        $this->assertEquals($vars['content'], 'hola');
    }

    /**
     * @covers Jepi\Fw\View\View::get
     * @depends testAddVar
     */
    public function testGet() {
        $template = $this->object->get('basic.php');

        $this->assertEquals("<div>hola</div>", $template);
    }

}