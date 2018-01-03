<?php

namespace Twizo\Api\Entity\Application;

use Twizo\Api\AbstractEntity;
use Twizo\Api\Entity\Exception;

/**
 * Application VerificationTypes entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class VerificationTypes extends AbstractEntity
{
    /**
     * @var null|array
     */
    protected $verificationTypes;

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'application/verification_types';
    }

    /**
     * @return null|array
     */
    public function getVerificationTypes()
    {
        return $this->verificationTypes;
    }

    /**
     * Load the balance data from the server
     *
     * @throws Exception
     */
    public function loadData()
    {
        $response = $this->sendApiCall(self::ACTION_RETRIEVE, $this->getCreateUrl());
        $this->verificationTypes = $response->getBody();
    }
}
