<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lpa\PhantomJs\Procedure;

use Lpa\PhantomJs\Engine;
use Lpa\PhantomJs\Cache\CacheInterface;
use Lpa\PhantomJs\Parser\ParserInterface;
use Lpa\PhantomJs\Template\TemplateRendererInterface;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@lpa.me>
 */
class ProcedureFactory implements ProcedureFactoryInterface
{
    /**
     * PhantomJS engine
     *
     * @var \Lpa\PhantomJs\Engine
     * @access protected
     */
    protected $engine;

    /**
     * Parser.
     *
     * @var \Lpa\PhantomJs\Parser\ParserInterface
     * @access protected
     */
    protected $parser;

    /**
     * Cache handler.
     *
     * @var \Lpa\PhantomJs\Cache\CacheInterface
     * @access protected
     */
    protected $cacheHandler;

    /**
     * Template renderer.
     *
     * @var \Lpa\PhantomJs\Template\TemplateRendererInterface
     * @access protected
     */
    protected $renderer;

    /**
     * Internal constructor.
     *
     * @access public
     * @param \Lpa\PhantomJs\Engine                             $engine
     * @param \Lpa\PhantomJs\Parser\ParserInterface             $parser
     * @param \Lpa\PhantomJs\Cache\CacheInterface               $cacheHandler
     * @param \Lpa\PhantomJs\Template\TemplateRendererInterface $renderer
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
     * @return \Lpa\PhantomJs\Procedure\Procedure
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
