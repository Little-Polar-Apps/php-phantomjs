<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace LittlePolarApps\PhantomJs\Tests\Unit\Procedure;

use Twig_Environment;
use Twig_Loader_String;
use LittlePolarApps\PhantomJs\Engine;
use LittlePolarApps\PhantomJs\Cache\FileCache;
use LittlePolarApps\PhantomJs\Cache\CacheInterface;
use LittlePolarApps\PhantomJs\Parser\JsonParser;
use LittlePolarApps\PhantomJs\Parser\ParserInterface;
use LittlePolarApps\PhantomJs\Template\TemplateRenderer;
use LittlePolarApps\PhantomJs\Template\TemplateRendererInterface;
use LittlePolarApps\PhantomJs\Procedure\ProcedureFactory;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@little-polar-apps.me>
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

        $this->assertInstanceOf('\LittlePolarApps\PhantomJs\Procedure\Procedure', $procedureFactory->createProcedure());
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get procedure factory instance.
     *
     * @access protected
     * @param  \LittlePolarApps\PhantomJs\Engine                             $engine
     * @param  \LittlePolarApps\PhantomJs\Parser\ParserInterface             $parser
     * @param  \LittlePolarApps\PhantomJs\Cache\CacheInterface               $cacheHandler
     * @param  \LittlePolarApps\PhantomJs\Template\TemplateRendererInterface $renderer
     * @return \LittlePolarApps\PhantomJs\Procedure\ProcedureFactory
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
     * @return \LittlePolarApps\PhantomJs\Engine
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
     * @return \LittlePolarApps\PhantomJs\Parser\JsonParser
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
     * @return \LittlePolarApps\PhantomJs\Cache\FileCache
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
     * @return \LittlePolarApps\PhantomJs\Template\TemplateRenderer
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
