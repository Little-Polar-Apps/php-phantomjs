<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lpa\PhantomJs\Http;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@lpa.me>
 */
class MessageFactory implements MessageFactoryInterface
{
    /**
     * Client instance
     *
     * @var \Lpa\PhantomJs\Http\MessageFactory
     * @access private
     */
    private static $instance;

    /**
     * Get singleton instance.
     *
     * @access public
     * @return \Lpa\PhantomJs\Http\MessageFactory
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof MessageFactoryInterface) {
            self::$instance = new MessageFactory();
        }

        return self::$instance;
    }

    /**
     * Create request instance.
     *
     * @access public
     * @param  string                         $url
     * @param  string                         $method
     * @param  int                            $timeout
     * @return \Lpa\PhantomJs\Http\Request
     */
    public function createRequest($url = null, $method = RequestInterface::METHOD_GET, $timeout = 5000)
    {
        return new Request($url, $method, $timeout);
    }

    /**
     * Create capture request instance.
     *
     * @access public
     * @param  string                                $url
     * @param  string                                $method
     * @param  int                                   $timeout
     * @return \Lpa\PhantomJs\Http\CaptureRequest
     */
    public function createCaptureRequest($url = null, $method = RequestInterface::METHOD_GET, $timeout = 5000)
    {
        return new CaptureRequest($url, $method, $timeout);
    }

    /**
     * Create PDF request instance.
     *
     * @access public
     * @param  string                            $url
     * @param  string                            $method
     * @param  int                               $timeout
     * @return \Lpa\PhantomJs\Http\PdfRequest
     */
    public function createPdfRequest($url = null, $method = RequestInterface::METHOD_GET, $timeout = 5000)
    {
        return new PdfRequest($url, $method, $timeout);
    }

    /**
     * Create response instance.
     *
     * @access public
     * @return \Lpa\PhantomJs\Http\Response
     */
    public function createResponse()
    {
        return new Response();
    }
}
