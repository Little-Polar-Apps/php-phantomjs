<?php

/*
 * This file is part of the php-phantomjs.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Lpa\PhantomJs\Test;

use Lpa\PhantomJs\DependencyInjection\ServiceContainer;

/**
 * PHP PhantomJs
 *
 * @author Jon Wenmoth <contact@lpa.me>
 */
class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Get dependency injection container.
     *
     * @access public
     * @return \Lpa\PhantomJs\DependencyInjection\ServiceContainer
     */
    public function getContainer()
    {
        return ServiceContainer::getInstance();
    }
}
