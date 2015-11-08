<?php

namespace Jepi\Fw\IO;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2015-11-07 at 22:07:27.
 */
class RequestTest extends \PHPUnit_Framework_TestCase {

    /**
     * @var Request
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->object = new Request(false);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    /**
     * @covers Jepi\Fw\IO\Request::getRequest
     */
    public function testGetRequest() {
        $request = $this->object->getRequest();

        /**
         * Check if keys of requests are not false because Request() has default non value as a false, but
         * RequestData() is defined to null
         */
        $this->assertNotFalse($request->getRemoteAddr());
        $this->assertNotFalse($request->getRemoteHost());
        $this->assertNotFalse($request->getRemotePort());
        $this->assertNotFalse($request->getMethod());
        $this->assertNotFalse($request->getScriptFilename());
        $this->assertNotFalse($request->getTime());
        $this->assertNotFalse($request->getTimeFloat());
        $this->assertNotFalse($request->getQueryString());
        $this->assertNotFalse($request->getUri());
        $this->assertNotFalse($request->getUserAgent());
    }

    /**
     * @covers Jepi\Fw\IO\Request::getHeader
     */
    public function testGetHeader() {
        $header = $this->object->getHeader('cache');

        $this->assertFalse($header);
    }

}
