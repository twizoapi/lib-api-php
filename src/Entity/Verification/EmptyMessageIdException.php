<?php

namespace Twizo\Api\Entity\Verification;

use Twizo\Api\Entity\Exception as EntityException;

/**
 * Verification empty message id exception class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class EmptyMessageIdException extends EntityException
{
    /**
     * Exception constructor
     */
    public function __construct()
    {
        parent::__construct('No message ID supplied for verification', self::VERIFICATION_FAILED);
    }
}
