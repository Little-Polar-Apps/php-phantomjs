<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace LittlePolarApps\PhantomJs\Procedure;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@little-polar-apps.me>
 */
interface ProcedureLoaderFactoryInterface
{
    /**
     * Create procedure loader instance.
     *
     * @access public
     * @param  string                                               $directory
     * @return \LittlePolarApps\PhantomJs\Procedure\ProcedureLoaderInterface
     */
    public function createProcedureLoader($directory);
}
