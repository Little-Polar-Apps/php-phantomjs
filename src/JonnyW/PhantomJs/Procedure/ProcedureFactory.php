<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LittlePolarApps\PhantomJs\Procedure;

use LittlePolarApps\PhantomJs\Engine;
use LittlePolarApps\PhantomJs\Cache\CacheInterface;
use LittlePolarApps\PhantomJs\Parser\ParserInterface;
use LittlePolarApps\PhantomJs\Template\TemplateRendererInterface;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@little-polar-apps.me>
 */
class ProcedureFactory implements ProcedureFactoryInterface
{
    /**
     * PhantomJS engine
     *
     * @var \LittlePolarApps\PhantomJs\Engine
     * @access protected
     */
    protected $engine;

    /**
     * Parser.
     *
     * @var \LittlePolarApps\PhantomJs\Parser\ParserInterface
     * @access protected
     */
    protected $parser;

    /**
     * Cache handler.
     *
     * @var \LittlePolarApps\PhantomJs\Cache\CacheInterface
     * @access protected
     */
    protected $cacheHandler;

    /**
     * Template renderer.
     *
     * @var \LittlePolarApps\PhantomJs\Template\TemplateRendererInterface
     * @access protected
     */
    protected $renderer;

    /**
     * Internal constructor.
     *
     * @access public
     * @param \LittlePolarApps\PhantomJs\Engine                             $engine
     * @param \LittlePolarApps\PhantomJs\Parser\ParserInterface             $parser
     * @param \LittlePolarApps\PhantomJs\Cache\CacheInterface               $cacheHandler
     * @param \LittlePolarApps\PhantomJs\Template\TemplateRendererInterface $renderer
     */
    public function __construct(Engine $engine, ParserInterface $parser, CacheInterface $cacheHandler, TemplateRendererInterface $renderer)
    {
        $this->engine       = $engine;
        $this->parser       = $parser;
        $this->cacheHandler = $cacheHandler;
        $this->renderer     = $renderer;
    }

    /**
     * Create new procedure instance.
     *
     * @access public
     * @return \LittlePolarApps\PhantomJs\Procedure\Procedure
     */
    public function createProcedure()
    {
        $procedure = new Procedure(
            $this->engine,
            $this->parser,
            $this->cacheHandler,
            $this->renderer
        );

        return $procedure;
    }
}
