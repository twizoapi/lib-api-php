<?php

namespace Twizo\Api;

/**
 * Response from api server
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Response implements Response\RestStatusCodesInterface
{
    /**
     * @var array
     */
    protected $body;

    /**
     * @var int
     */
    protected $statusCode;

    /**
     * Constructor
     *
     * @param array $body
     * @param int   $statusCode
     */
    public function __construct($body, $statusCode)
    {
        $this->body = $body;
        $this->statusCode = $statusCode;
    }

    /**
     * @return array
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }
}
