<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lpa\PhantomJs\Tests\Unit;

use Lpa\PhantomJs\Client;
use Lpa\PhantomJs\Engine;
use Lpa\PhantomJs\Http\MessageFactoryInterface;
use Lpa\PhantomJs\Procedure\ProcedureLoaderInterface;
use Lpa\PhantomJs\Procedure\ProcedureCompilerInterface;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@lpa.me>
 */
class ClientTest extends \PHPUnit_Framework_TestCase
{

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test can get client through
     * factory method.
     *
     * @access public
     * @return void
     */
    public function testCanGetClientThroughFactoryMethod()
    {
        $this->assertInstanceOf('\Lpa\PhantomJs\Client', Client::getInstance());
    }

    /**
     * Test can get engine.
     *
     * @return void
     */
    public function testCanGetEngne()
    {
        $engine             = $this->getEngine();
        $procedureLoader    = $this->getProcedureLoader();
        $procedureCompiler  = $this->getProcedureCompiler();
        $messageFactory     = $this->getMessageFactory();

        $client = $this->getClient($engine, $procedureLoader, $procedureCompiler, $messageFactory);

        $this->assertInstanceOf('\Lpa\PhantomJs\Engine', $client->getEngine());
    }

    /**
     * Test can get message factory
     *
     * @return void
     */
    public function testCanGetMessageFactory()
    {
        $engine             = $this->getEngine();
        $procedureLoader    = $this->getProcedureLoader();
        $procedureCompiler  = $this->getProcedureCompiler();
        $messageFactory     = $this->getMessageFactory();

        $client = $this->getClient($engine, $procedureLoader, $procedureCompiler, $messageFactory);

        $this->assertInstanceOf('\Lpa\PhantomJs\Http\MessageFactoryInterface', $client->getMessageFactory());
    }

    /**
     * Test can get procedure loader.
     *
     * @return void
     */
    public function testCanGetProcedureLoader()
    {
        $engine             = $this->getEngine();
        $procedureLoader    = $this->getProcedureLoader();
        $procedureCompiler  = $this->getProcedureCompiler();
        $messageFactory     = $this->getMessageFactory();

        $client = $this->getClient($engine, $procedureLoader, $procedureCompiler, $messageFactory);

        $this->assertInstanceOf('\Lpa\PhantomJs\Procedure\ProcedureLoaderInterface', $client->getProcedureLoader());
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get client instance
     *
     * @param  \Lpa\PhantomJs\Engine                               $engine
     * @param  \Lpa\PhantomJs\Procedure\ProcedureLoaderInterface   $procedureLoader
     * @param  \Lpa\PhantomJs\Procedure\ProcedureCompilerInterface $procedureCompiler
     * @param  \Lpa\PhantomJs\Http\MessageFactoryInterface         $messageFactory
     * @return \Lpa\PhantomJs\Client
     */
    protected function getClient(Engine $engine, ProcedureLoaderInterface $procedureLoader, ProcedureCompilerInterface $procedureCompiler, MessageFactoryInterface $messageFactory)
    {
        $client = new Client($engine, $procedureLoader, $procedureCompiler, $messageFactory);

        return $client;
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ MOCKS / STUBS ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get engine
     *
     * @access protected
     * @return \Lpa\PhantomJs\Engine
     */
    protected function getEngine()
    {
        $engine = $this->getMock('\Lpa\PhantomJs\Engine');

        return $engine;
    }

    /**
     * Get message factory
     *
     * @access protected
     * @return \Lpa\PhantomJs\Http\MessageFactoryInterface
     */
    protected function getMessageFactory()
    {
        $messageFactory = $this->getMock('\Lpa\PhantomJs\Http\MessageFactoryInterface');

        return $messageFactory;
    }

    /**
     * Get procedure loader.
     *
     * @access protected
     * @return \Lpa\PhantomJs\Procedure\ProcedureLoaderInterface
     */
    protected function getProcedureLoader()
    {
        $procedureLoader = $this->getMock('\Lpa\PhantomJs\Procedure\ProcedureLoaderInterface');

        return $procedureLoader;
    }

    /**
     * Get procedure validator.
     *
     * @access protected
     * @return \Lpa\PhantomJs\Procedure\ProcedureCompilerInterface
     */
    protected function getProcedureCompiler()
    {
        $procedureCompiler = $this->getMock('\Lpa\PhantomJs\Procedure\ProcedureCompilerInterface');

        return $procedureCompiler;
    }
}
