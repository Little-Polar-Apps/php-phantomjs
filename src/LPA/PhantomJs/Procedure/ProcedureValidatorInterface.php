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
interface ProcedureValidatorInterface
{
    /**
     * Validate procedure.
     *
     * @access public
     * @param  string                                                   $procedure
     * @return boolean
     * @throws \Lpa\PhantomJs\Exception\ProcedureValidationException
     */
    public function validate($procedure);
}
