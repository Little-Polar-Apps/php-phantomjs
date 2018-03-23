<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace LittlePolarApps\PhantomJs;

use LittlePolarApps\PhantomJs\Procedure\ProcedureLoaderInterface;
use LittlePolarApps\PhantomJs\Procedure\ProcedureCompilerInterface;
use LittlePolarApps\PhantomJs\Http\MessageFactoryInterface;
use LittlePolarApps\PhantomJs\Http\RequestInterface;
use LittlePolarApps\PhantomJs\Http\ResponseInterface;
use LittlePolarApps\PhantomJs\DependencyInjection\ServiceContainer;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@little-polar-apps.me>
 */
class Client implements ClientInterface
{
    /**
     * Client.
     *
     * @var \LittlePolarApps\PhantomJs\ClientInterface
     * @access private
     */
    private static $instance;

    /**
     * PhantomJs engine.
     *
     * @var \LittlePolarApps\PhantomJs\Engine
     * @access protected
     */
    protected $engine;

    /**
     * Procedure loader.
     *
     * @var \LittlePolarApps\PhantomJs\Procedure\ProcedureLoaderInterface
     * @access protected
     */
    protected $procedureLoader;

    /**
     * Procedure validator.
     *
     * @var \LittlePolarApps\PhantomJs\Procedure\ProcedureCompilerInterface
     * @access protected
     */
    protected $procedureCompiler;

    /**
     * Message factory.
     *
     * @var \LittlePolarApps\PhantomJs\Http\MessageFactoryInterface
     * @access protected
     */
    protected $messageFactory;

    /**
     * Procedure template
     *
     * @var string
     * @access protected
     */
    protected $procedure;

    /**
     * Internal constructor
     *
     * @access public
     * @param  \LittlePolarApps\PhantomJs\Engine                               $engine
     * @param  \LittlePolarApps\PhantomJs\Procedure\ProcedureLoaderInterface   $procedureLoader
     * @param  \LittlePolarApps\PhantomJs\Procedure\ProcedureCompilerInterface $procedureCompiler
     * @param  \LittlePolarApps\PhantomJs\Http\MessageFactoryInterface         $messageFactory
     * @return void
     */
    public function __construct(Engine $engine, ProcedureLoaderInterface $procedureLoader, ProcedureCompilerInterface $procedureCompiler, MessageFactoryInterface $messageFactory)
    {
        $this->engine            = $engine;
        $this->procedureLoader   = $procedureLoader;
        $this->procedureCompiler = $procedureCompiler;
        $this->messageFactory    = $messageFactory;
        $this->procedure         = 'http_default';
    }

    /**
     * Get singleton instance
     *
     * @access public
     * @return \LittlePolarApps\PhantomJs\Client
     */
    public static function getInstance()
    {
        if (!self::$instance instanceof ClientInterface) {

            $serviceContainer = ServiceContainer::getInstance();

            self::$instance = new static(
                $serviceContainer->get('engine'),
                $serviceContainer->get('procedure_loader'),
                $serviceContainer->get('procedure_compiler'),
                $serviceContainer->get('message_factory')
            );
        }

        return self::$instance;
    }

    /**
     * Get PhantomJs engine.
     *
     * @access public
     * @return \LittlePolarApps\PhantomJs\Engine
     */
    public function getEngine()
    {
        return $this->engine;
    }

    /**
     * Get message factory instance
     *
     * @access public
     * @return \LittlePolarApps\PhantomJs\Http\MessageFactoryInterface
     */
    public function getMessageFactory()
    {
        return $this->messageFactory;
    }

    /**
     * Get procedure loader instance
     *
     * @access public
     * @return \LittlePolarApps\PhantomJs\Procedure\ProcedureLoaderInterface
     */
    public function getProcedureLoader()
    {
        return $this->procedureLoader;
    }

    /**
     * Send request
     *
     * @access public
     * @param  \LittlePolarApps\PhantomJs\Http\RequestInterface  $request
     * @param  \LittlePolarApps\PhantomJs\Http\ResponseInterface $response
     * @return \LittlePolarApps\PhantomJs\Http\ResponseInterface
     */
    public function send(RequestInterface $request, ResponseInterface $response)
    {
        $procedure = $this->procedureLoader->load($this->procedure);

        $this->procedureCompiler->compile($procedure, $request);

        $procedure->run($request, $response);

        return $response;
    }

    /**
     * Get log.
     *
     * @access public
     * @return string
     */
    public function getLog()
    {
        return $this->getEngine()->getLog();
    }

    /**
     * Set procedure template.
     *
     * @access public
     * @param  string $procedure
     * @return void
     */
    public function setProcedure($procedure)
    {
        $this->procedure = $procedure;
    }

    /**
     * Get procedure template.
     *
     * @access public
     * @return string
     */
    public function getProcedure()
    {
        return $this->procedure;
    }

    /**
     * Get procedure compiler.
     *
     * @access public
     * @return \LittlePolarApps\PhantomJs\Procedure\ProcedureCompilerInterface
     */
    public function getProcedureCompiler()
    {
        return $this->procedureCompiler;
    }

    /**
     * Set lazy request flag.
     *
     * @access public
     * @return void
     */
    public function isLazy()
    {
        $this->procedure = 'http_lazy';
    }
}
