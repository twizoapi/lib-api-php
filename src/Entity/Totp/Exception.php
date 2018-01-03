<?php

namespace Twizo\Api\Entity\Totp;

use Twizo\Api\Entity\Exception as EntityException;
use Twizo\Api\Response\RestStatusCodesInterface;

/**
 * Verification exception class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Exception extends EntityException
{
    const NO_IDENTIFIER_SUPPLIED = 1;
    const ERROR_TOKEN_ALREADY_VERIFIED = 101;
    const ERROR_TOKEN_VERIFICATION_EXPIRED = 102;
    const ERROR_TOKEN_INVALID_TOKEN = 103;
    const ERROR_TOKEN_VERIFY_FAILED = 104;

    /**
     * Constructor
     *
     * @param EntityException $e
     */
    public function __construct(EntityException $e)
    {
        switch ($e->getJsonErrorCode()) {
            case self::ERROR_TOKEN_ALREADY_VERIFIED:
                $message = 'A totp verification was already completed in current time window';
                break;
            case self::ERROR_TOKEN_VERIFICATION_EXPIRED:
                $message = 'TOTP expired';
                break;
            case self::ERROR_TOKEN_INVALID_TOKEN:
                $message = 'Invalid token supplied';
                break;
            case self::ERROR_TOKEN_VERIFY_FAILED:
                $message = 'Verification was not send';
                break;
            default:
                $message = 'Verification of token failed';
                break;
        }

        parent::__construct($message, self::VERIFICATION_FAILED, $e->getStatusCode(), $e->getJsonErrorCode());
    }

    /**
     * @return int
     */
    public function getVerificationErrorCode()
    {
        return $this->jsonErrorCode;
    }

    /**
     * Get a list of all valid json status codes for verification failures
     *
     * @return array
     */
    protected static function getVerificationJsonStatusCodes()
    {
        return array(
            self::ERROR_TOKEN_ALREADY_VERIFIED,
            self::ERROR_TOKEN_VERIFICATION_EXPIRED,
            self::ERROR_TOKEN_INVALID_TOKEN,
            self::ERROR_TOKEN_VERIFY_FAILED,
        );
    }

    /**
     * Test if the entity exception is the result of a verification exception
     *
     * @param EntityException $e
     *
     * @return bool
     */
    public static function isTotpException(EntityException $e)
    {
        if (in_array($e->getStatusCode(), array(RestStatusCodesInterface::REST_CLIENT_ERROR_UNPROCESSABLE_ENTITY, RestStatusCodesInterface::REST_CLIENT_ERROR_LOCKED))
            && in_array($e->getJsonErrorCode(), self::getVerificationJsonStatusCodes())
        ) {
            return true;
        } else {
            return false;
        }
    }
}
