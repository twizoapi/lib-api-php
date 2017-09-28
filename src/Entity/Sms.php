<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractEntity;

/**
 * Sms entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Sms extends AbstractEntity
{
    // Type of sms: simple will automatically split large messages into multiple sms messages, advanced will reject too large messages
    const TYPE_SIMPLE = 'simple';
    const TYPE_ADVANCED = 'advanced';

    // Bit masks of which type of result type to send
    const RESULT_TYPE_CALLBACK = 1;
    const RESULT_TYPE_POLL = 2;

    /**
     * @var string|null
     */
    protected $applicationTag;

    /**
     * @var string|null
     */
    protected $body = '';

    /**
     * @var string|null
     */
    protected $callbackUrl;

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
    protected $messageId;

    /**
     * @var int|null
     */
    protected $networkCode;

    /**
     * @var int|null
     */
    protected $pid;

    /**
     * @var int|null
     */
    protected $reasonCode;

    /**
     * @var string|null
     */
    protected $recipient;

    /**
     * @var array
     */
    protected $recipients = array();

    /**
     * @var string|null
     */
    protected $resultTimestamp;

    /**
     * @var int|null
     */
    protected $resultType;

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
    protected $scheduledDelivery;

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
    protected $status;

    /**
     * @var int|null
     */
    protected $statusCode;

    /**
     * @var string|null
     */
    protected $tag;

    /**
     * @var string|null
     */
    protected $type = self::TYPE_ADVANCED;

    /**
     * @var string|null
     */
    protected $udh;

    /**
     * @var string|null
     */
    protected $validUntilDateTime;

    /**
     * @var int|null
     */
    protected $validity;

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
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return string|null
     */
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        if ($this->type == self::TYPE_SIMPLE) {
            return 'sms/submitsimple';
        } else {
            return 'sms/submit';
        }
    }

    /**
     * @return string|null
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
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @return int|null
     */
    public function getNetworkCode()
    {
        return $this->networkCode;
    }

    /**
     * @return int|null
     */
    public function getPid()
    {
        return $this->pid;
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
     * @return array
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @return string|null
     */
    public function getResultTimestamp()
    {
        return $this->resultTimestamp;
    }

    /**
     * @return int|null
     */
    public function getResultType()
    {
        return $this->resultType;
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
    public function getScheduledDelivery()
    {
        return $this->scheduledDelivery;
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
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return int|null
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
     * @return string|null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return string|null
     */
    public function getUdh()
    {
        return $this->udh;
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
     * Return true if the sms has been configured as binary message
     *
     * @return bool
     */
    protected function isBinary()
    {
        $binary = false;

        if (($this->dcs & 200) === 0) {
            $binary = (($this->dcs & 4) > 0);
        } elseif (($this->dcs & 248) === 240) {
            $binary = (($this->dcs & 4) > 0);
        }

        return $binary;
    }

    /**
     * Send message to server and return response
     *
     * @return Sms[]
     *
     * @throws Exception
     */
    public function send()
    {
        // Convert body to hex when the message is binary
        if ($this->isBinary()) {
            $this->postFields['body'] = strtoupper(bin2hex($this->body));
        }

        $response = $this->sendApiCall(self::ACTION_CREATE, $this->getCreateUrl());

        if (!isset($response->getBody()['_embedded']['items'])) {
            throw new Exception('Invalid response returned from server', Exception::INVALID_RESPONSE);
        }

        $result = array();
        foreach ($response->getBody()['_embedded']['items'] as $item) {
            $result[] = $sms = new Sms($this->client, $this->factory);
            $sms->setFields($item);
        }

        return $result;
    }

    /**
     * Automatically split multi part sms messages and return result sms messages
     *
     * @return Sms[]
     *
     * @throws Exception
     */
    public function sendSimple()
    {
        $this->setType(self::TYPE_SIMPLE);
        $response = $this->sendApiCall(self::ACTION_CREATE, $this->getCreateUrl());

        if (!isset($response->getBody()['_embedded']['items'])) {
            throw new Exception('Invalid response returned from server', Exception::INVALID_RESPONSE);
        }

        $result = array();
        foreach ($response->getBody()['_embedded']['items'] as $item) {
            $result[] = $sms = new Sms($this->client, $this->factory);
            $sms->setFields($item);
            $sms->setType(self::TYPE_SIMPLE);
        }

        return $result;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
        $this->addPostField('body');
    }

    /**
     * @param string $callbackUrl
     */
    public function setCallbackUrl($callbackUrl)
    {
        $this->callbackUrl = $callbackUrl;
        $this->addPostField('callbackUrl');
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
     * @param int $pid
     */
    public function setPid($pid)
    {
        $this->pid = $pid;
        $this->addPostField('pid');
    }

    /**
     * @param array $recipients
     */
    public function setRecipients(array $recipients)
    {
        $this->recipients = $recipients;
        $this->addPostField('recipients');
    }

    /**
     * @param int $resultType
     */
    public function setResultType($resultType)
    {
        $this->resultType = $resultType;
        $this->addPostField('resultType');
    }

    /**
     * @param string $scheduledDelivery
     */
    public function setScheduledDelivery($scheduledDelivery)
    {
        $this->scheduledDelivery = $scheduledDelivery;
        $this->addPostField('scheduledDelivery');
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
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @param string $udh
     */
    public function setUdh($udh)
    {
        $this->udh = $udh;
        $this->addPostField('udh');
    }

    /**
     * @param int $validity
     */
    public function setValidity($validity)
    {
        $this->validity = $validity;
        $this->addPostField('validity');
    }
}
