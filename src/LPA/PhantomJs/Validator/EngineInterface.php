<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lpa\PhantomJs\Validator;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@lpa.me>
 */
interface EngineInterface
{
    /**
     * Returns engine as string.
     *
     * @access public
     * @return string
     */
    public function toString();
}
