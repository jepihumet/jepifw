<?php

namespace Jepi\Fw\IO;
use Jepi\Fw\Test\FwTestBase;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-06-12 at 14:51:34.
 */
class RequestDataTest extends FwTestBase {

    /**
     * @var RequestData
     */
    protected static $object;

    public static function setUpBeforeClass() {
        parent::setUpBeforeClass();

        self::$object = self::$container->get('\Jepi\Fw\IO\RequestData');
    }

    /**
     * @covers Jepi\Fw\IO\RequestData::getRemoteHost
     */
    public function testGetRemoteHost() {
        $this->assertFalse(self::$object->getRemoteHost());
    }

    /**
     * @covers Jepi\Fw\IO\RequestData::getRemoteAddr
     */
    public function testGetRemoteAddr() {
        $this->assertFalse(self::$object->getRemoteAddr());
    }

    /**
     * @covers Jepi\Fw\IO\RequestData::getRemotePort
     */
    public function testGetRemotePort() {
        $this->assertFalse(self::$object->getRemotePort());
    }

    /**
     * @covers Jepi\Fw\IO\RequestData::getUri
     */
    public function testGetUri() {
        $this->assertFalse(self::$object->getUri());
    }

    /**
     * @covers Jepi\Fw\IO\RequestData::getMethod
     */
    public function testGetMethod() {
        $this->assertFalse(self::$object->getMethod());
    }

    /**
     * @covers Jepi\Fw\IO\RequestData::getTime
     */
    public function testGetTime() {
        $this->assertEquals("integer",gettype(self::$object->getTime()));
    }

    /**
     * @covers Jepi\Fw\IO\RequestData::getTimeFloat
     */
    public function testGetTimeFloat() {
        $this->assertEquals("double",gettype(self::$object->getTimeFloat()));
    }

    /**
     * @covers Jepi\Fw\IO\RequestData::getUserAgent
     */
    public function testGetUserAgent() {
        $this->assertFalse(self::$object->getUserAgent());
    }

    /**
     * @covers Jepi\Fw\IO\RequestData::getScriptFilename
     */
    public function testGetScriptFilename() {
        $this->assertEquals("string",gettype(self::$object->getScriptFilename()));
    }

    /**
     * @covers Jepi\Fw\IO\RequestData::getQueryString
     */
    public function testGetQueryString() {
        $this->assertFalse(self::$object->getQueryString());
    }

}
