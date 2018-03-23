<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lpa\PhantomJs;

use Lpa\PhantomJs\Http\RequestInterface;
use Lpa\PhantomJs\Http\ResponseInterface;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@lpa.me>
 */
interface ClientInterface
{
    /**
     * Get singleton instance
     *
     * @access public
     * @return \Lpa\PhantomJs\ClientInterface
     */
    public static function getInstance();

    /**
     * Get engine instance.
     *
     * @access public
     * @return \Lpa\PhantomJs\Engine
     */
    public function getEngine();

    /**
     * Get message factory instance
     *
     * @access public
     * @return \Lpa\PhantomJs\Http\MessageFactoryInterface
     */
    public function getMessageFactory();

    /**
     * Get procedure loader instance
     *
     * @access public
     * @return \Lpa\PhantomJs\Procedure\ProcedureLoaderInterface
     */
    public function getProcedureLoader();

    /**
     * Send request
     *
     * @access public
     * @param \Lpa\PhantomJs\Http\RequestInterface  $request
     * @param \Lpa\PhantomJs\Http\ResponseInterface $response
     */
    public function send(RequestInterface $request, ResponseInterface $response);

    /**
     * Get log.
     *
     * @access public
     * @return string
     */
    public function getLog();

    /**
     * Set procedure template.
     *
     * @access public
     * @param  string $procedure
     * @return void
     */
    public function setProcedure($procedure);

    /**
     * Get procedure template.
     *
     * @access public
     * @return string
     */
    public function getProcedure();

    /**
     * Set lazy request flag.
     *
     * @access public
     * @return void
     */
    public function isLazy();
}
