<?php

namespace Jepi\Fw\DependencyInjection;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-11-26 at 15:19:42.
 */
class DITest extends \PHPUnit_Framework_TestCase {

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        require_once 'ClassesTestDI.php';
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Jepi\Fw\DependencyInjection\DI::get
     */
    public function testGet() {
        $a = DI::get('ClassA');

        $this->assertEquals("ClassA", get_class($a));
    }

}
