<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractEntity;
use Twizo\Api\Entity\BioVoiceRegistration\EmptyRegistrationIdException;

/**
 * BioVoice registration entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class BioVoiceRegistration extends AbstractEntity
{
    const STATUS_NO_STATUS = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_REJECTED = 2;
    const STATUS_EXPIRED = 3;
    const STATUS_FAILED = 4;

    /**
     * @var string|null
     */
    protected $createdDateTime;

    /**
     * @var string|null
     */
    protected $language;

    /**
     * @var int|null
     */
    protected $reasonCode;

    /**
     * @var string|null
     */
    protected $recipient;

    /**
     * @var string|null
     */
    protected $registrationId;

    /**
     * @var float|null
     */
    protected $salesPrice;

    /**
     * @var string|null
     */
    protected $salesPriceCurrencyCode;

    /**
     * @var string|null
     */
    protected $status;

    /**
     * @var int|null
     */
    protected $statusCode;

    /**
     * @var null|string
     */
    protected $voiceSentence;

    /**
     * @var string|null
     */
    protected $webHook;

    /**
     * @throws Exception
     */
    public function create()
    {
        $this->sendApiCall(self::ACTION_CREATE, $this->getCreateUrl());
    }

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'biovoice/registration';
    }

    /**
     * @return null|string
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @return null|string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @return null|int
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * @return null|string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return null|string
     */
    public function getRegistrationId()
    {
        return $this->registrationId;
    }

    /**
     * @return null|float
     */
    public function getSalesPrice()
    {
        return $this->salesPrice;
    }

    /**
     * @return null|string
     */
    public function getSalesPriceCurrencyCode()
    {
        return $this->salesPriceCurrencyCode;
    }

    /**
     * @return null|string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return null|int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @return null|string
     */
    public function getVoiceSentence()
    {
        return $this->voiceSentence;
    }

    /**
     * @return null|string
     */
    public function getWebHook()
    {
        return $this->webHook;
    }

    /**
     * @param string $id
     *
     * @throws Exception
     */
    public function populate($id)
    {
        if (empty($id)) {
            throw new EmptyRegistrationIdException();
        }

        $this->sendApiCall(self::ACTION_RETRIEVE, $this->getCreateUrl() . '/' . urlencode($id));
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
     * @param string $webHook
     */
    public function setWebHook($webHook)
    {
        $this->webHook = $webHook;
        $this->addPostField('webHook');
    }
}
