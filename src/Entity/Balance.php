<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractEntity;

/**
 * Balance entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Balance extends AbstractEntity
{
    /**
     * @var float
     */
    protected $credit;

    /**
     * @var string
     */
    protected $currencyCode;

    /**
     * @var int
     */
    protected $freeVerifications;

    /**
     * @var string
     */
    protected $wallet;

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'wallet/getbalance';
    }

    /**
     * @return float
     */
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * @return string
     */
    public function getCurrencyCode()
    {
        return $this->currencyCode;
    }

    /**
     * @return int
     */
    public function getFreeVerifications()
    {
        return $this->freeVerifications;
    }

    /**
     * @return string
     */
    public function getWallet()
    {
        return $this->wallet;
    }

    /**
     * Load the balance data from the server
     */
    public function loadData()
    {
        $this->sendApiCall(self::ACTION_RETRIEVE, $this->getCreateUrl());
    }
}
