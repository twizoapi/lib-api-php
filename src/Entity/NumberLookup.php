<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractEntity;

/**
 * Number lookup entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class NumberLookup extends AbstractEntity
{
    // Bitmasks of which type of result type to send
    const RESULT_TYPE_CALLBACK = 1;
    const RESULT_TYPE_POLL = 2;

    // Used for is roaming / is ported fields
    const VALUE_YES = 'Yes';
    const VALUE_NO = 'No';
    const VALUE_UNKNOWN = 'Unknown';

    /**
     * @var string|null
     */
    protected $applicationTag;

    /**
     * @var string|null
     */
    protected $callbackUrl;

    /**
     * @var string|null
     */
    protected $countryCode;

    /**
     * @var string|null
     */
    protected $createdDateTime;

    /**
     * @var string|null;
     */
    protected $imsi;

    /**
     * @var string|null
     */
    protected $isPorted;

    /**
     * @var string|null
     */
    protected $isRoaming;

    /**
     * @var string|null
     */
    protected $messageId;

    /**
     * @var string|null
     */
    protected $msc;

    /**
     * @var int|null
     */
    protected $networkCode;

    /**
     * @var string
     */
    protected $number;

    /**
     * @var array
     */
    protected $numbers = array();

    /**
     * @var string|null
     */
    protected $operator;

    /**
     * @var int|null
     */
    protected $reasonCode;

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
     * @var string|null
     */
    protected $salesPriceCurrencyCode;

    /**
     * @var float|null
     */
    protected $salesPriceEuro;

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
    public function getCallbackUrl()
    {
        return $this->callbackUrl;
    }

    /**
     * @return string|null
     */
    public function getCountryCode()
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'numberlookup/submit';
    }

    /**
     * @return string|null
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @return string|null
     */
    public function getImsi()
    {
        return $this->imsi;
    }

    /**
     * @return string|null
     */
    public function getIsPorted()
    {
        return $this->isPorted;
    }

    /**
     * @return string|null
     */
    public function getIsRoaming()
    {
        return $this->isRoaming;
    }

    /**
     * @return string|null
     */
    public function getMessageId()
    {
        return $this->messageId;
    }

    /**
     * @return string|null
     */
    public function getMsc()
    {
        return $this->msc;
    }

    /**
     * @return int|null
     */
    public function getNetworkCode()
    {
        return $this->networkCode;
    }

    /**
     * @return string|null
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @return array|null
     */
    public function getNumbers()
    {
        return $this->numbers;
    }

    /**
     * @return string|null
     */
    public function getOperator()
    {
        return $this->operator;
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
     * @return string|null
     */
    public function getSalesPriceCurrencyCode()
    {
        return $this->salesPriceCurrencyCode;
    }

    /**
     * @return float|null
     */
    public function getSalesPriceEuro()
    {
        return $this->salesPriceEuro;
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
     * @return null|string
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
     * Send message to server and return response
     *
     * @return NumberLookup[]
     *
     * @throws Exception
     */
    public function send()
    {
        $response = $this->sendApiCall(self::ACTION_CREATE, $this->getCreateUrl());

        if (!isset($response->getBody()['_embedded']['items'])) {
            throw new Exception('Invalid response returned from server', Exception::INVALID_RESPONSE);
        }

        $result = array();
        foreach ($response->getBody()['_embedded']['items'] as $item) {
            $result[] = $sms = new NumberLookup($this->client, $this->factory);
            $sms->setFields($item);
        }

        return $result;
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
     * @param array $numbers
     */
    public function setNumbers(array $numbers)
    {
        $this->numbers = $numbers;
        $this->addPostField('numbers');
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
     * @param string $tag
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        $this->addPostField('tag');
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
