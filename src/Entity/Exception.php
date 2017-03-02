<?php

namespace Twizo\Api\Entity;

/**
 * Entity exception class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Exception extends \Twizo\Api\Exception
{
    /**
     * @var int|null
     */
    protected $jsonErrorCode;

    /**
     * @var int|null
     */
    protected $statusCode = null;

    /**
     * Constructor
     *
     * @param string   $message
     * @param int      $code
     * @param int|null $statusCode
     * @param int      $jsonErrorCode
     */
    public function __construct($message, $code, $statusCode = null, $jsonErrorCode = null)
    {
        parent::__construct($message, $code);

        $this->statusCode = $statusCode;
        $this->jsonErrorCode = $jsonErrorCode;
    }

    /**
     * Return the json error code
     *
     * @return int|null
     */
    public function getJsonErrorCode()
    {
        return $this->jsonErrorCode;
    }

    /**
     * @return int|null
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
