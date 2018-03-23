<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lpa\PhantomJs\Tests\Unit\Procedure;

use Twig_Environment;
use Twig_Loader_String;
use Lpa\PhantomJs\Engine;
use Lpa\PhantomJs\Cache\FileCache;
use Lpa\PhantomJs\Cache\CacheInterface;
use Lpa\PhantomJs\Parser\JsonParser;
use Lpa\PhantomJs\Parser\ParserInterface;
use Lpa\PhantomJs\Template\TemplateRenderer;
use Lpa\PhantomJs\Template\TemplateRendererInterface;
use Lpa\PhantomJs\Procedure\ProcedureFactory;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@lpa.me>
 */
class ProcedureFactoryTest extends \PHPUnit_Framework_TestCase
{

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test factory can create instance of
     * procedure.
     *
     * @access public
     * @return void
     */
    public function testFactoryCanCreateInstanceOfProcedure()
    {
        $engine    = $this->getEngine();
        $parser    = $this->getParser();
        $cache     = $this->getCache();
        $renderer  = $this->getRenderer();

        $procedureFactory = $this->getProcedureFactory($engine, $parser, $cache, $renderer);

        $this->assertInstanceOf('\Lpa\PhantomJs\Procedure\Procedure', $procedureFactory->createProcedure());
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get procedure factory instance.
     *
     * @access protected
     * @param  \Lpa\PhantomJs\Engine                             $engine
     * @param  \Lpa\PhantomJs\Parser\ParserInterface             $parser
     * @param  \Lpa\PhantomJs\Cache\CacheInterface               $cacheHandler
     * @param  \Lpa\PhantomJs\Template\TemplateRendererInterface $renderer
     * @return \Lpa\PhantomJs\Procedure\ProcedureFactory
     */
    protected function getProcedureFactory(Engine $engine, ParserInterface $parser, CacheInterface $cacheHandler, TemplateRendererInterface $renderer)
    {
        $procedureFactory = new ProcedureFactory($engine, $parser, $cacheHandler, $renderer);

        return $procedureFactory;
    }

    /**
     * Get engine.
     *
     * @access protected
     * @return \Lpa\PhantomJs\Engine
     */
    protected function getEngine()
    {
        $engine = new Engine();

        return $engine;
    }

    /**
     * Get parser.
     *
     * @access protected
     * @return \Lpa\PhantomJs\Parser\JsonParser
     */
    protected function getParser()
    {
        $parser = new JsonParser();

        return $parser;
    }

    /**
     * Get cache.
     *
     * @access protected
     * @param  string                            $cacheDir  (default: '')
     * @param  string                            $extension (default: 'proc')
     * @return \Lpa\PhantomJs\Cache\FileCache
     */
    protected function getCache($cacheDir = '', $extension = 'proc')
    {
        $cache = new FileCache(($cacheDir ? $cacheDir : sys_get_temp_dir()), 'proc');

        return $cache;
    }

    /**
     * Get template renderer.
     *
     * @access protected
     * @return \Lpa\PhantomJs\Template\TemplateRenderer
     */
    protected function getRenderer()
    {
        $twig = new Twig_Environment(
            new Twig_Loader_String()
        );

        $renderer = new TemplateRenderer($twig);

        return $renderer;
    }
}
