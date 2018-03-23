<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Lpa\PhantomJs\Procedure;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@lpa.me>
 */
interface ProcedureCompilerInterface
{
    /**
     * Compile partials into procedure.
     *
     * @access public
     * @param \Lpa\PhantomJs\Procedure\ProcedureInterface $procedure
     * @param \Lpa\PhantomJs\Procedure\InputInterface     $input
     */
    public function compile(ProcedureInterface $procedure, InputInterface $input);

    /**
     * Load partial template.
     *
     * @access public
     * @param  string $name
     * @return string
     */
    public function load($name);

    /**
     * Enable cache.
     *
     * @access public
     * @return void
     */
    public function enableCache();

    /**
     * Disable cache.
     *
     * @access public
     * @return void
     */
    public function disableCache();

    /**
     * Clear cache.
     *
     * @access public
     * @return void
     */
    public function clearCache();
}
