<?php

namespace Twizo\Api\Entity\BioVoiceRegistration;

use Twizo\Api\Entity\Exception as EntityException;

/**
 * BioVoice registration empty registrationId exception class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class EmptyRegistrationIdException extends EntityException
{
    /**
     * Exception constructor
     */
    public function __construct()
    {
        parent::__construct('No registrationId supplied for bio voice registration', self::BIO_VOICE_FAILED);
    }
}
