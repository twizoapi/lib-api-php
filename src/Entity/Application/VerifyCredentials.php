<?php

namespace Twizo\Api\Entity\Application;

use Twizo\Api\AbstractEntity;
use Twizo\Api\Exception;

/**
 * Application VerifyCredentials entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class VerifyCredentials extends AbstractEntity
{
    /**
     * @var null|string
     */
    protected $applicationTag;

    /**
     * @var null|bool
     */
    protected $isTestKey;

    /**
     * @return null|string
     */
    public function getApplicationTag()
    {
        return $this->applicationTag;
    }

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'application/verifycredentials';
    }

    /**
     * @return null|bool
     */
    public function getIsTestKey()
    {
        return $this->isTestKey;
    }

    /**
     * Load the balance data from the server
     *
     * @throws Exception
     */
    public function loadData()
    {
        $this->sendApiCall(self::ACTION_RETRIEVE, $this->getCreateUrl());
    }
}
