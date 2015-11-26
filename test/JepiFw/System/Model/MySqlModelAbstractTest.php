<?php

namespace Jepi\Fw\Model;

use Jepi\Fw\Config\Config;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-11-26 at 08:57:09.
 */
class MySqlModelAbstractTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var ModelExample
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $config = new Config();
        $config->loadFile(dirname(__FILE__) . '/../../../../JepiFw/App/Config/config.ini');
        $connections = new Connections($config);

        $this->object = new ModelExample($connections);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Jepi\Fw\Model\MySqlModelAbstract::select
     */
    public function testSelect() {
        /*$data = $this->object->listUsers();
        $this->assertEquals(0, count($data));*/
    }

    /**
     * @covers Jepi\Fw\Model\MySqlModelAbstract::insert
     * @depends testSelect
     */
    public function testInsert() {
        $createdId = $this->object->createUser('jepihumet');
        $this->assertGreaterThanOrEqual(1, $createdId);

        $data = $this->object->getUser($createdId);
        $this->assertEquals($createdId, $data['id']);
        $this->assertEquals('jepihumet', $data['name']);
        return $createdId;
    }

    /**
     * @covers Jepi\Fw\Model\MySqlModelAbstract::update
     * @depends testInsert
     * @param $createdId
     */
    public function testUpdate($createdId) {
        $updated = $this->object->updateUser($createdId, 'testuser');
        $this->assertEquals(1, $updated);

        $data = $this->object->getUser($createdId);
        $this->assertEquals($createdId, $data['id']);
        $this->assertEquals('testuser', $data['name']);
        return $createdId;
    }

    /**
     * @covers Jepi\Fw\Model\MySqlModelAbstract::delete
     * @depends testUpdate
     * @param $createdId
     */
    public function testDelete($createdId) {
        $deleted = $this->object->deleteUser($createdId);
        $this->assertEquals(1, $deleted);

        $data = $this->object->listUsers();
        $this->assertEquals(0, count($data));
    }

}