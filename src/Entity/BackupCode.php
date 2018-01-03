<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractEntity;
use Twizo\Api\Entity\Exception as EntityException;
use Twizo\Api\Response;

/**
 * BackupCode entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class BackupCode extends AbstractEntity
{
    /**
     * @var int|null
     */
    protected $amountOfCodesLeft;

    /**
     * @var array|null
     */
    protected $codes;

    /**
     * @var int|null
     */
    protected $createdDateTime;

    /**
     * @var string|null
     */
    protected $identifier;

    /**
     * @var Verification|null
     */
    protected $verification;

    /**
     * @throws Exception
     */
    public function create()
    {
        $this->sendApiCall(self::ACTION_CREATE, $this->getCreateUrl());
    }

    /**
     * @throws Exception
     */
    public function delete()
    {
        $this->sendApiCall(self::ACTION_REMOVE, $this->getCreateUrl() . '/' . urlencode($this->identifier));
    }

    /**
     * @return int|null
     */
    public function getAmountOfCodesLeft()
    {
        return $this->amountOfCodesLeft;
    }

    /**
     * @return array|null
     */
    public function getCodes()
    {
        return $this->codes;
    }

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'backupcode';
    }

    /**
     * @return int|null
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @return string|null
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return Verification|Null
     */
    public function getVerification()
    {
        return $this->verification;
    }

    /**
     * @param string $id
     *
     * @throws Exception
     */
    public function populate($id)
    {
        if (empty($id)) {
            throw new Exception('No identifier supplied for backup code', BackupCode\Exception::NO_IDENTIFIER_SUPPLIED);
        }

        $this->sendApiCall(self::ACTION_RETRIEVE, $this->getCreateUrl() . '/' . urlencode($id));
    }

    /**
     * @param string $verb
     * @param string $location
     *
     * @return Response
     *
     * @throws BackupCode\Exception
     * @throws EntityException
     */
    protected function sendApiCall($verb, $location)
    {
        try {
            return parent::sendApiCall($verb, $location);
        } catch (EntityException $exception) {
            if (BackupCode\Exception::isBackupCodeException($exception)) {
                throw new BackupCode\Exception($exception);
            }

            throw $exception;
        }
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        $this->addPostField('identifier');
    }

    /**
     * @throws Exception
     */
    public function update()
    {
        $this->sendApiCall(self::ACTION_UPDATE, $this->getCreateUrl() . '/' . urlencode($this->identifier));
    }

    /**
     * @param string      $token
     * @param string|null $identifier
     *
     * @throws Exception
     */
    public function verify($token, $identifier = null)
    {
        $identifier = ($identifier !== null) ? $identifier : $this->identifier;

        // Throw error for empty token or empty identifier, because the server will not handle this
        if (empty($token)) {
            throw new BackupCode\EmptyTokenException();
        }
        if (empty($identifier)) {
            throw new BackupCode\EmptyIdentifierException();
        }

        $this->sendApiCall(self::ACTION_RETRIEVE, sprintf('%s/%s?token=%s', $this->getCreateUrl(), urlencode($identifier), $token));
    }
}
