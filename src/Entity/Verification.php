<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractEntity;

/**
 * Verification entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Verification extends AbstractEntity
{
    const TYPE_CALL = 'call';
    const TYPE_SMS = 'sms';
    const TYPE_PUSH = 'push';
    const TYPE_BIO_VOICE = 'biovoice';
    const TYPE_TELEGRAM = 'telegram';
    const TYPE_LINE = 'line';
    const TYPE_FACEBOOK_MESSENGER = 'facebook_messenger';

    const TOKEN_TYPE_NUMERIC = 'numeric';
    const TOKEN_TYPE_ALPHANUMERIC = 'alphanumeric';

    const STATUS_NO_STATUS = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_REJECTED = 2;
    const STATUS_EXPIRED = 3;
    const STATUS_FAILED = 4;

    /**
     * @var string|null
     */
    protected $applicationTag;

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
    protected $messageId;

    /**
     * @var int|null
     */
    protected $reasonCode;

    /**
     * @var string|null
     */
    protected $recipient;

    /**
     * @var float|null
     */
    protected $salesPrice;

    /**
     * @var float|null
     */
    protected $salesPriceCurrencyCode;

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
    protected $sessionId;

    /**
     * @var string|null
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
    protected $type;

    /**
     * @var string|null
     */
    protected $validUntilDateTime;

    /**
     * @var int|null
     */
    protected $validity;

    /**
     * @var string|null
     */
    protected $voiceSentence;

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
    public function getBodyTemplate()
    {
        return $this->bodyTemplate;
    }

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'verification/submit';
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
     * @return string|null
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return string|null
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @return int|null
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * @return string|null
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return float|null
     */
    public function getSalesPrice()
    {
        return $this->salesPrice;
    }

    /**
     * @return float|null
     */
    public function getSalesPriceCurrencyCode()
    {
        return $this->salesPriceCurrencyCode;
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
     * @return string|null
     */
    public function getSessionId()
    {
        return $this->sessionId;
    }

    /**
     * @return string|null
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
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getValidUntilDateTime()
    {
        return $this->validUntilDateTime;
    }

    /**
     * @return int|null
     */
    public function getValidity()
    {
        return $this->validity;
    }

    /**
     * @return null|string
     */
    public function getVoiceSentence()
    {
        return $this->voiceSentence;
    }

    /**
     * Create entity on server
     *
     * @throws Exception
     */
    public function send()
    {
        $this->sendApiCall(self::ACTION_CREATE, $this->getCreateUrl());
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
     * @param string $sessionId
     */
    public function setSessionId($sessionId)
    {
        $this->sessionId = $sessionId;
        $this->addPostField('sessionId');
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
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
        $this->addPostField('type');
    }

    /**
     * @param int $validity
     */
    public function setValidity($validity)
    {
        $this->validity = $validity;
        $this->addPostField('validity');
    }

    /**
     * @param string $token
     * @param null   $messageId
     *
     * @throws Exception
     */
    public function verify($token, $messageId = null)
    {
        $messageId = ($messageId !== null) ? $messageId : $this->messageId;

        // Throw error for empty token or empty message id, because the server will not handle this
        if (empty($token)) {
            throw new Verification\EmptyTokenException();
        }
        if (empty($messageId)) {
            throw new Verification\EmptyMessageIdException();
        }

        try {
            $this->sendApiCall(self::ACTION_RETRIEVE, sprintf('%s/%s?token=%s', $this->getCreateUrl(), urlencode($messageId), $token));
        } catch (Exception $e) {
            if (Verification\Exception::isVerificationException($e)) {
                throw new Verification\Exception($e);
            } else {
                throw $e;
            }
        }
    }
}
