<?php

namespace Twizo\Api;

/**
 * General Twizo exception class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Exception extends \Exception
{
    const SERVER_UNAVAILABLE = 1;
    const INVALID_RESPONSE = 2;
    const VALIDATION_ERRORS = 3;
    const VERIFICATION_FAILED = 4;
    // Code 5 was used for NO_CURL_FOUND
    const INVALID_FIELDS = 6;
    const NO_MESSAGE_ID_SUPPLIED = 7;
    const INVALID_APPLICATION_SECRET = 8;
    const UNDEFINED_FIELD_ACCESSED = 9;
    const SERVICE_UNAVAILABLE = 10;
    const ENTITY_NOT_FOUND = 11;
    const BACKUP_CODE_FAILED = 12;
    const INSUFFICIENT_CREDIT = 13;
    const BIO_VOICE_FAILED = 14;
}
