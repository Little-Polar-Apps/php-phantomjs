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
use Symfony\Component\Config\FileLocatorInterface;
use Lpa\PhantomJs\Engine;
use Lpa\PhantomJs\Cache\FileCache;
use Lpa\PhantomJs\Cache\CacheInterface;
use Lpa\PhantomJs\Parser\JsonParser;
use Lpa\PhantomJs\Parser\ParserInterface;
use Lpa\PhantomJs\Template\TemplateRenderer;
use Lpa\PhantomJs\Template\TemplateRendererInterface;
use Lpa\PhantomJs\Procedure\ProcedureFactory;
use Lpa\PhantomJs\Procedure\ProcedureFactoryInterface;
use Lpa\PhantomJs\Procedure\ProcedureLoader;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@lpa.me>
 */
class ProcedureLoaderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test filename
     *
     * @var string
     * @access protected
     */
    protected $filename;

    /**
     * Test directory
     *
     * @var string
     * @access protected
     */
    protected $directory;

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++++ TESTS ++++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Test invalid argument exception is thrown if procedure
     * file is not local.
     *
     * @access public
     * @return void
     */
    public function testInvalidArgumentExceptionIsThrownIfProcedureFileIsNotLocal()
    {
        $this->setExpectedException('\InvalidArgumentException');

        $procedureFactory = $this->getProcedureFactory();
        $fileLocator      = $this->getFileLocator();

        $fileLocator->method('locate')
            ->will($this->returnValue('http://example.com/index.html'));

        $procedureLoader = $this->getProcedureLoader($procedureFactory, $fileLocator);
        $procedureLoader->load('test');
    }

    /**
     * Test load throws not exists exception if
     * if procedure file does not exist.
     *
     * @access public
     * @return void
     */
    public function testNotExistsExceptionIsThrownIfProcedureFileDoesNotExist()
    {
        $this->setExpectedException('\Lpa\PhantomJs\Exception\NotExistsException');

        $procedureFactory = $this->getProcedureFactory();
        $fileLocator      = $this->getFileLocator();

        $fileLocator->method('locate')
            ->will($this->returnValue('/invalid/file.proc'));

        $procedureLoader = $this->getProcedureLoader($procedureFactory, $fileLocator);
        $procedureLoader->load('test');
    }

    /**
     * Test procedure can be laoded.
     *
     * @access public
     * @return void
     */
    public function testProcedureCanBeLoaded()
    {
        $body = 'TEST_PROCEDURE';
        $file = $this->writeProcedure($body);

        $procedureFactory = $this->getProcedureFactory();
        $fileLocator      = $this->getFileLocator();

        $fileLocator->method('locate')
            ->will($this->returnValue($file));

        $procedureLoader = $this->getProcedureLoader($procedureFactory, $fileLocator);

        $this->assertInstanceOf('\Lpa\PhantomJs\Procedure\ProcedureInterface', $procedureLoader->load('test'));
    }

    /**
     * Test procedure template is set in procedure
     * instance.
     *
     * @access public
     * @return void
     */
    public function testProcedureTemplateIsSetInProcedureInstance()
    {
        $body = 'TEST_PROCEDURE';
        $file = $this->writeProcedure($body);

        $procedureFactory = $this->getProcedureFactory();
        $fileLocator      = $this->getFileLocator();

        $fileLocator->method('locate')
            ->will($this->returnValue($file));

        $procedureLoader = $this->getProcedureLoader($procedureFactory, $fileLocator);

        $this->assertSame($body, $procedureLoader->load('test')->getTemplate());
    }

    /**
     * Test procedure template can be loaded.
     *
     * @access public
     * @return void
     */
    public function testProcedureTemplateCanBeLoaded()
    {
        $body = 'TEST_PROCEDURE';
        $file = $this->writeProcedure($body);

        $procedureFactory = $this->getProcedureFactory();
        $fileLocator      = $this->getFileLocator();

        $fileLocator->method('locate')
            ->will($this->returnValue($file));

        $procedureLoader = $this->getProcedureLoader($procedureFactory, $fileLocator);

        $this->assertNotNull($procedureLoader->loadTemplate('test'));
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ TEST ENTITIES ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get procedure loader instance.
     *
     * @access public
     * @param  \Lpa\PhantomJs\Procedure\ProcedureFactoryInterface $procedureFactory
     * @param  \Symfony\Component\Config\FileLocatorInterface        $locator
     * @return \Lpa\PhantomJs\Procedure\ProcedureLoader
     */
    protected function getProcedureLoader(ProcedureFactoryInterface $procedureFactory, FileLocatorInterface $locator)
    {
        $procedureLoader = new ProcedureLoader($procedureFactory, $locator);

        return $procedureLoader;
    }

    /**
     * Get procedure factory instance.
     *
     * @access protected
     * @param  \Lpa\PhantomJs\Parser\ParserInterface             $parser
     * @param  \Lpa\PhantomJs\Cache\CacheInterface               $cacheHandler
     * @param  \Lpa\PhantomJs\Template\TemplateRendererInterface $renderer
     * @return \Lpa\PhantomJs\Procedure\ProcedureFactory
     */
    protected function getProcedureFactory()
    {
        $engine   = $this->getEngine();
        $parser   = $this->getParser();
        $cache    = $this->getCache();
        $renderer = $this->getRenderer();

        $procedureFactory = new ProcedureFactory($engine, $parser, $cache, $renderer);

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

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++ MOCKS / STUBS ++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Get file locator.
     *
     * @access protected
     * @return \Symfony\Component\Config\FileLocatorInterface
     */
    protected function getFileLocator()
    {
        $fileLocator = $this->getMock('\Symfony\Component\Config\FileLocatorInterface');

        return $fileLocator;
    }

/** +++++++++++++++++++++++++++++++++++ **/
/** ++++++++++++ UTILITIES ++++++++++++ **/
/** +++++++++++++++++++++++++++++++++++ **/

    /**
     * Set up test environment.
     *
     * @access public
     * @return void
     */
    public function setUp()
    {
        $this->filename  = 'test.proc';
        $this->directory = sys_get_temp_dir();

        if (!is_writable($this->directory)) {
            throw new \RuntimeException(sprintf('Test directory must be writable: %s', $this->directory));
        }
    }

    /**
     * Tear down test environment.
     *
     * @access public
     * @return void
     */
    public function tearDown()
    {
        $filename = $this->getFilename();

        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    /**
     * Get test filename.
     *
     * @access public
     * @return string
     */
    public function getFilename()
    {
        return sprintf('%1$s/%2$s', $this->directory, $this->filename);
    }

    /**
     * Write procedure body to file.
     *
     * @access public
     * @param  string $data
     * @return string
     */
    public function writeProcedure($procedure)
    {
        $filename = $this->getFilename();

        file_put_contents($filename, $procedure);

        return $filename;
    }
}
