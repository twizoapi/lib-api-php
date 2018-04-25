<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractEntity;
use Twizo\Api\Entity\Exception as EntityException;

/**
 * WidgetRegister session entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class WidgetRegisterSession extends AbstractEntity
{
    /**
     * @var array
     */
    protected $allowedTypes;

    /**
     * @var string|null
     */
    protected $applicationTag;

    /**
     * @var string|null
     */
    protected $backupCodeIdentifier;

    /**
     * @var string|null
     */
    protected $createdDateTime;

    /**
     * @var string|null
     */
    protected $issuer;

    /**
     * @var string|null
     */
    protected $language;

    /**
     * @var string|null
     */
    protected $recipient;

    /**
     * @var array
     */
    protected $registeredTypes;

    /**
     * @var string|null
     */
    protected $sessionToken;

    /**
     * @var int|null
     */
    protected $status;

    /**
     * @var string|null
     */
    protected $statusCode;

    /**
     * @var string|null
     */
    protected $totpIdentifier;

    /**
     * Create widget
     *
     * @throws Exception
     */
    public function create()
    {
        $this->sendApiCall(self::ACTION_CREATE, $this->getCreateUrl());
    }

    /**
     * @return array
     */
    public function getAllowedTypes()
    {
        return $this->allowedTypes;
    }

    /**
     * @return null|string
     */
    public function getApplicationTag()
    {
        return $this->applicationTag;
    }

    /**
     * @return null|string
     */
    public function getBackupCodeIdentifier()
    {
        return $this->backupCodeIdentifier;
    }

    /**
     * @return null|string
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'widget-register-verification/session';
    }

    /**
     * @return null|string
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * @return null|string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return null|string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return array
     */
    public function getRegisteredTypes()
    {
        return $this->registeredTypes;
    }

    /**
     * @return null|string
     */
    public function getSessionToken()
    {
        return $this->sessionToken;
    }

    /**
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return null|string
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return null|string
     */
    public function getTotpIdentifier()
    {
        return $this->totpIdentifier;
    }

    /**
     * @param array $allowedTypes
     */
    public function setAllowedTypes($allowedTypes)
    {
        $this->allowedTypes = $allowedTypes;
        $this->addPostField('allowedTypes');
    }

    /**
     * @param null|string $backupCodeIdentifier
     */
    public function setBackupCodeIdentifier($backupCodeIdentifier)
    {
        $this->backupCodeIdentifier = $backupCodeIdentifier;
        $this->addPostField('backupCodeIdentifier');
    }

    /**
     * @param null|string $issuer
     */
    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;
        $this->addPostField('issuer');
    }

    /**
     * @param null|string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        $this->addPostField('language');
    }

    /**
     * @param null|string $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        $this->addPostField('recipient');
    }

    /**
     * @param null|string $totpIdentifier
     */
    public function setTotpIdentifier($totpIdentifier)
    {
        $this->totpIdentifier = $totpIdentifier;
        $this->addPostField('totpIdentifier');
    }
}
