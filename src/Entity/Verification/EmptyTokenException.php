<?php

namespace Twizo\Api\Entity\Verification;

use Twizo\Api\Entity\Exception as EntityException;

/**
 * Verification empty token exception class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class EmptyTokenException extends EntityException
{
    /**
     * Exception constructor
     */
    public function __construct()
    {
        parent::__construct('Empty token supplied for verification', self::VERIFICATION_FAILED);
    }
}
