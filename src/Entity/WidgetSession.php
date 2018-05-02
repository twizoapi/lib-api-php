<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractEntity;
use Twizo\Api\Entity\Exception as EntityException;

/**
 * Widget entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class WidgetSession extends AbstractEntity
{
    const TYPE_CALL = 'call';
    const TYPE_SMS = 'sms';
    const TYPE_BACKUP_CODE = 'backupcode';
    const TYPE_TOTP = 'totp';
    const TYPE_PUSH = 'push';
    const TYPE_BIO_VOICE = 'biovoice';
    const TYPE_TELEGRAM = 'telegram';
    const TYPE_LINE = 'line';
    const TYPE_FACEBOOK_MESSENGER = 'facebook_messenger';

    const TOKEN_TYPE_NUMERIC = 'numeric';
    const TOKEN_TYPE_ALPHANUMERIC = 'alphanumeric';

    const STATUS_NO_STATUS = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_EXPIRED = 2;
    const STATUS_MAX_ATTEMPTS = 3;

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
    protected $bodyTemplate;

    /**
     * @var string|null
     */
    protected $createdDateTime;

    /**
     * @var int|null
     */
    protected $dcs;

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
    protected $preferredType;

    /**
     * @var string|null
     */
    protected $recipient;

    /**
     * @var string|null
     */
    protected $sender;

    /**
     * @var int|null
     */
    protected $senderNpi;

    /**
     * @var int|null
     */
    protected $senderTon;

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
    protected $tag;

    /**
     * @var int|null
     */
    protected $tokenLength;

    /**
     * @var string|null
     */
    protected $tokenType;

    /**
     * @var string|null
     */
    protected $totpIdentifier;

    /**
     * @var Verification|null
     */
    protected $verification;

    /**
     * @var array|null
     */
    protected $verificationIds;

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
     * @return string|null
     */
    public function getApplicationTag()
    {
        return $this->applicationTag;
    }

    /**
     * @return string|null
     */
    public function getBackupCodeIdentifier()
    {
        return $this->backupCodeIdentifier;
    }

    /**
     * @return string|null
     */
    public function getBodyTemplate()
    {
        return $this->bodyTemplate;
    }

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'widget/session';
    }

    /**
     * @return null|string
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @return int|null
     */
    public function getDcs()
    {
        return $this->dcs;
    }

    /**
     * @return null|string
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return null|string
     */
    public function getPreferredType()
    {
        return $this->preferredType;
    }

    /**
     * @return string|null
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return string|null
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return int|null
     */
    public function getSenderNpi()
    {
        return $this->senderNpi;
    }

    /**
     * @return int|null
     */
    public function getSenderTon()
    {
        return $this->senderTon;
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
     * @return string|null
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return string|null
     */
    public function getTag()
    {
        return $this->tag;
    }

    /**
     * @return int|null
     */
    public function getTokenLength()
    {
        return $this->tokenLength;
    }

    /**
     * @return string|null
     */
    public function getTokenType()
    {
        return $this->tokenType;
    }

    /**
     * @return null|string
     */
    public function getTotpIdentifier()
    {
        return $this->totpIdentifier;
    }

    /**
     * @return Verification|null
     */
    public function getVerification()
    {
        return $this->verification;
    }

    /**
     * @return array|null
     */
    public function getVerificationIds()
    {
        return $this->verificationIds;
    }

    /**
     * @param string      $id
     * @param string|null $recipient
     * @param string|null $backupCodeIdentifier
     * @param string|null $totpIdentifier
     *
     * @throws EntityException
     */
    public function populate($id, $recipient = null, $backupCodeIdentifier = null, $totpIdentifier = null)
    {
        if (empty($id)) {
            throw new EntityException('No messages id supplied', EntityException::NO_MESSAGE_ID_SUPPLIED);
        }
        if ($recipient === null && $backupCodeIdentifier === null && $totpIdentifier === null) {
            throw new EntityException('No recipient, backup code identifier or totp identifier supplied', EntityException::INVALID_FIELDS);
        }

        $params = [];
        if ($recipient !== null) {
            $params['recipient'] = $recipient;
        }
        if ($backupCodeIdentifier !== null) {
            $params['backupCodeIdentifier'] = $backupCodeIdentifier;
        }
        if ($totpIdentifier !== null) {
            $params['totpIdentifier'] = $totpIdentifier;
        }

        $this->sendApiCall(self::ACTION_RETRIEVE, $this->getCreateUrl() . '/' . urlencode($id) . '?' . http_build_query($params));
    }

    /**
     * @param array $allowedTypes
     */
    public function setAllowedTypes(array $allowedTypes)
    {
        $this->allowedTypes = $allowedTypes;
        $this->addPostField('allowedTypes');
    }

    /**
     * @param string $backupCodeIdentifier
     */
    public function setBackupCodeIdentifier($backupCodeIdentifier)
    {
        $this->backupCodeIdentifier = $backupCodeIdentifier;
        $this->addPostField('backupCodeIdentifier');
    }

    /**
     * @param string $bodyTemplate
     */
    public function setBodyTemplate($bodyTemplate)
    {
        $this->bodyTemplate = $bodyTemplate;
        $this->addPostField('bodyTemplate');
    }

    /**
     * @param int $dcs
     */
    public function setDcs($dcs)
    {
        $this->dcs = $dcs;
        $this->addPostField('dcs');
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
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
        $this->addPostField('language');
    }

    /**
     * @param string $preferredType
     */
    public function setPreferredType($preferredType)
    {
        $this->preferredType = $preferredType;
        $this->addPostField('preferredType');
    }

    /**
     * @param string $recipient
     */
    public function setRecipient($recipient)
    {
        $this->recipient = $recipient;
        $this->addPostField('recipient');
    }

    /**
     * @param string $sender
     */
    public function setSender($sender)
    {
        $this->sender = $sender;
        $this->addPostField('sender');
    }

    /**
     * @param int $senderNpi
     */
    public function setSenderNpi($senderNpi)
    {
        $this->senderNpi = $senderNpi;
        $this->addPostField('senderNpi');
    }

    /**
     * @param int $senderTon
     */
    public function setSenderTon($senderTon)
    {
        $this->senderTon = $senderTon;
        $this->addPostField('senderTon');
    }

    /**
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        $this->addPostField('tag');
    }

    /**
     * @param int $tokenLength
     */
    public function setTokenLength($tokenLength)
    {
        $this->tokenLength = $tokenLength;
        $this->addPostField('tokenLength');
    }

    /**
     * @param string $tokenType
     */
    public function setTokenType($tokenType)
    {
        $this->tokenType = $tokenType;
        $this->addPostField('tokenType');
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
