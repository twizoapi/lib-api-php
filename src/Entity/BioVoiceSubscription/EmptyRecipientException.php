<?php

namespace Twizo\Api\Entity\BioVoiceSubscription;

use Twizo\Api\Entity\Exception as EntityException;

/**
 * BioVoice subscription empty recipient exception class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class EmptyRecipientException extends EntityException
{
    /**
     * Exception constructor
     */
    public function __construct()
    {
        parent::__construct('No recipient supplied for bio voice subscription', self::BIO_VOICE_FAILED);
    }
}
