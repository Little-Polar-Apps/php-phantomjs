<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace LittlePolarApps\PhantomJs\Tests\Unit;

use LittlePolarApps\PhantomJs\Client;
use LittlePolarApps\PhantomJs\Engine;
use LittlePolarApps\PhantomJs\Http\MessageFactoryInterface;
use LittlePolarApps\PhantomJs\Procedure\ProcedureLoaderInterface;
use LittlePolarApps\PhantomJs\Procedure\ProcedureCompilerInterface;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@little-polar-apps.me>
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
        $this->assertInstanceOf('\LittlePolarApps\PhantomJs\Client', Client::getInstance());
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

        $this->assertInstanceOf('\LittlePolarApps\PhantomJs\Engine', $client->getEngine());
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

        $this->assertInstanceOf('\LittlePolarApps\PhantomJs\Http\MessageFactoryInterface', $client->getMessageFactory());
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

        $this->assertInstanceOf('\LittlePolarApps\PhantomJs\Procedure\ProcedureLoaderInterface', $client->getProcedureLoader());
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get client instance
     *
     * @param  \LittlePolarApps\PhantomJs\Engine                               $engine
     * @param  \LittlePolarApps\PhantomJs\Procedure\ProcedureLoaderInterface   $procedureLoader
     * @param  \LittlePolarApps\PhantomJs\Procedure\ProcedureCompilerInterface $procedureCompiler
     * @param  \LittlePolarApps\PhantomJs\Http\MessageFactoryInterface         $messageFactory
     * @return \LittlePolarApps\PhantomJs\Client
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
     * @return \LittlePolarApps\PhantomJs\Engine
     */
    protected function getEngine()
    {
        $engine = $this->getMock('\LittlePolarApps\PhantomJs\Engine');

        return $engine;
    }

    /**
     * Get message factory
     *
     * @access protected
     * @return \LittlePolarApps\PhantomJs\Http\MessageFactoryInterface
     */
    protected function getMessageFactory()
    {
        $messageFactory = $this->getMock('\LittlePolarApps\PhantomJs\Http\MessageFactoryInterface');

        return $messageFactory;
    }

    /**
     * Get procedure loader.
     *
     * @access protected
     * @return \LittlePolarApps\PhantomJs\Procedure\ProcedureLoaderInterface
     */
    protected function getProcedureLoader()
    {
        $procedureLoader = $this->getMock('\LittlePolarApps\PhantomJs\Procedure\ProcedureLoaderInterface');

        return $procedureLoader;
    }

    /**
     * Get procedure validator.
     *
     * @access protected
     * @return \LittlePolarApps\PhantomJs\Procedure\ProcedureCompilerInterface
     */
    protected function getProcedureCompiler()
    {
        $procedureCompiler = $this->getMock('\LittlePolarApps\PhantomJs\Procedure\ProcedureCompilerInterface');

        return $procedureCompiler;
    }
}
