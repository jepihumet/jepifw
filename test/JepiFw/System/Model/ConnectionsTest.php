<?php

namespace Jepi\Fw\Model;
use Jepi\Fw\Test\FwTestBase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-11-24 at 23:37:32.
 */
class ConnectionsTest extends FwTestBase {

    /**
     * @var Connections
     */
    protected static $object;

    protected function setUp() {
        self::$object = self::$container->get('\Jepi\Fw\Model\Connections');
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Jepi\Fw\System\Model\ConnectionsManager::openMySqlConnection
     */
    public function testOpenMySqlConnection() {
        try {
            $connection = self::$object->openMySqlConnection('default');
            $this->assertEquals("PDO", get_class($connection));
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
    }

    /**
     * @depends testOpenMySqlConnection
     * @covers Jepi\Fw\System\Model\ConnectionsManager::closeConnection
     */
    public function testCloseConnection() {
        try {
            $closed = self::$object->closeConnection('default');
            $this->assertTrue($closed);
        } catch (Exception $e) {
            $this->assertTrue(false);
        }
    }

}
