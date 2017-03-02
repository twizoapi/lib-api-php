<?php

namespace Twizo\Api\Client;

use Twizo\Api\Response;

/**
 * Client exception class
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
     * @var Response
     */
    protected $response;

    /**
     * Exception constructor.
     *
     * @param string $message
     * @param int    $code
     * @param null   $response
     */
    public function __construct($message, $code, $response = null)
    {
        parent::__construct($message, $code);

        $this->response = $response;
    }

    /**
     * @return Response
     */
    public function getResponse()
    {
        return $this->response;
    }
}
