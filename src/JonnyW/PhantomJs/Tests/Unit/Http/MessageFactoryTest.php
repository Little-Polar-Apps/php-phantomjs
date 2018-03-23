<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace LittlePolarApps\PhantomJs\Tests\Unit\Http;

use LittlePolarApps\PhantomJs\Http\MessageFactory;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@little-polar-apps.me>
 */
class MessageFactoryTest extends \PHPUnit_Framework_TestCase
{

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test factory method creates message factory.
     *
     * @access public
     * @return void
     */
    public function testFactoryMethodCreatesMessageFactory()
    {
        $this->assertInstanceOf('\LittlePolarApps\PhantomJs\Http\MessageFactory', MessageFactory::getInstance());
    }

    /**
     * Test can create request.
     *
     * @access public
     * @return void
     */
    public function testCanCreateRequest()
    {
        $messageFactory = $this->getMessageFactory();

        $this->assertInstanceOf('\LittlePolarApps\PhantomJs\Http\Request', $messageFactory->createRequest());
    }

    /**
     * Test can create request with URL.
     *
     * @access public
     * @return void
     */
    public function testCanCreateRequestWithUrl()
    {
        $url = 'http://test.com';

        $messageFactory = $this->getMessageFactory();
        $request        = $messageFactory->createRequest($url);

        $this->assertSame($url, $request->getUrl());
    }

    /**
     * Test can create request with method.
     *
     * @access public
     * @return void
     */
    public function testCanCreateRequestWithMethod()
    {
        $method = 'POST';

        $messageFactory = $this->getMessageFactory();
        $request        = $messageFactory->createRequest(null, $method);

        $this->assertSame($method, $request->getMethod());
    }

    /**
     * Test can create request with timeout.
     *
     * @access public
     * @return void
     */
    public function testCanCreateRequestWithTimeout()
    {
        $timeout = 123456789;

        $messageFactory = $this->getMessageFactory();
        $request        = $messageFactory->createRequest(null, 'GET', $timeout);

        $this->assertSame($timeout, $request->getTimeout());
    }

    /**
     * Test can create capture request.
     *
     * @access public
     * @return void
     */
    public function testCanCreateCaptureRequest()
    {
        $messageFactory = $this->getMessageFactory();

        $this->assertInstanceOf('\LittlePolarApps\PhantomJs\Http\CaptureRequest', $messageFactory->createCaptureRequest());
    }

    /**
     * Test can create capture request with URL.
     *
     * @access public
     * @return void
     */
    public function testCanCreateCaptureRequestWithUrl()
    {
        $url = 'http://test.com';

        $messageFactory = $this->getMessageFactory();
        $captureRequest = $messageFactory->createCaptureRequest($url);

        $this->assertSame($url, $captureRequest->getUrl());
    }

    /**
     * Test can create capture request
     * with method.
     *
     * @access public
     * @return void
     */
    public function testCanCreateCaptureRequestWithMethod()
    {
        $method = 'POST';

        $messageFactory = $this->getMessageFactory();
        $captureRequest = $messageFactory->createCaptureRequest(null, $method);

        $this->assertSame($method, $captureRequest->getMethod());
    }

    /**
     * Test can create capture request with timeout.
     *
     * @access public
     * @return void
     */
    public function testCanCreateCaptureRequestWithTimeout()
    {
        $timeout = 123456789;

        $messageFactory = $this->getMessageFactory();
        $captureRequest = $messageFactory->createCaptureRequest(null, 'GET', $timeout);

        $this->assertSame($timeout, $captureRequest->getTimeout());
    }

    /**
     * Test can create response.
     *
     * @access public
     * @return void
     */
    public function testCanCreateResponse()
    {
        $messageFactory = $this->getMessageFactory();

        $this->assertInstanceOf('\LittlePolarApps\PhantomJs\Http\Response', $messageFactory->createResponse());
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get message factory instance.
     *
     * @access protected
     * @return \LittlePolarApps\PhantomJs\Http\MessageFactory
     */
    protected function getMessageFactory()
    {
        $messageFactory = new MessageFactory();

        return $messageFactory;
    }
}
