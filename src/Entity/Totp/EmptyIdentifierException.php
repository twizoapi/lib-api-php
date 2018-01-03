<?php

namespace Twizo\Api\Entity\Totp;

use Twizo\Api\Entity\Exception as EntityException;

/**
 * TOTP empty message id exception class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class EmptyIdentifierException extends EntityException
{
    /**
     * Exception constructor
     */
    public function __construct()
    {
        parent::__construct('No identifier supplied for TOTP', self::VERIFICATION_FAILED);
    }
}
