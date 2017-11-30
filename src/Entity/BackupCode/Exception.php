<?php

namespace Twizo\Api\Entity\BackupCode;

use Twizo\Api\Entity\Exception as EntityException;
use Twizo\Api\Response\RestStatusCodesInterface;

/**
 * BackupCode exception class
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
    const NO_TOKEN_SUPPLIED = 1;
    const IDENTIFIER_TOO_LONG = 2;
    const INVALID_TOKEN = 103;

    /**
     * Constructor
     *
     * @param EntityException $e
     */
    public function __construct(EntityException $e)
    {
        switch ($e->getJsonErrorCode()) {
            case self::INVALID_TOKEN:
                $message = 'Invalid token';
                break;
            case self::IDENTIFIER_TOO_LONG:
                $message = 'Identifier is too long';
                break;
            default:
                $message = $e->getMessage();
        }

        parent::__construct($message, self::BACKUP_CODE_FAILED, $e->getStatusCode(), $e->getJsonErrorCode());
    }

    /**
     * Get a list of all valid json status codes for backup code failures
     *
     * @return array
     */
    protected static function getBackupCodeJsonStatusCodes()
    {
        return array(
            self::NO_IDENTIFIER_SUPPLIED,
            self::NO_TOKEN_SUPPLIED,
            self::INVALID_TOKEN,
            self::IDENTIFIER_TOO_LONG,
        );
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->jsonErrorCode;
    }

    /**
     * Test if the entity exception is the result of a backup code exception
     *
     * @param EntityException $e
     *
     * @return bool
     */
    public static function isBackupCodeException(EntityException $e)
    {
        if (in_array($e->getStatusCode(), array(RestStatusCodesInterface::REST_CLIENT_ERROR_CONFLICT, RestStatusCodesInterface::REST_CLIENT_ERROR_UNPROCESSABLE_ENTITY, RestStatusCodesInterface::REST_CLIENT_ERROR_LOCKED))
            && in_array($e->getJsonErrorCode(), self::getBackupCodeJsonStatusCodes())
        ) {
            return true;
        } else {
            return false;
        }
    }
}
