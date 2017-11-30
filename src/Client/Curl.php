<?php

namespace Twizo\Api\Client;

use Twizo\Api\AbstractClient;
use Twizo\Api\Response;

/**
 * Curl client class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Curl extends AbstractClient
{
    /**
     * Curl constructor
     *
     * @param string $secret
     * @param string $apiHost
     */
    public function __construct($secret, $apiHost)
    {
        if (false === function_exists('curl_version')) {
            throw new \RuntimeException('Curl extension was not installed');
        }

        parent::__construct($secret, $apiHost);
    }

    /**
     * Add curl version to user agent
     *
     * @return array
     */
    public function getUserAgentInfo()
    {
        $curlVersion = curl_version();

        return array_merge(parent::getUserAgentInfo(), array('curl/' . $curlVersion["version"], 'php/' . phpversion()));
    }

    /**
     * @param string $verb
     * @param string $location
     * @param array  $fields
     *
     * @return Response
     *
     * @throws Exception
     */
    public function sendRequest($verb, $location, $fields)
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $this->getUrl($location));
        curl_setopt($curl, CURLOPT_USERPWD, self::API_USERNAME . ":" . $this->secret);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $verb);
        curl_setopt($curl, CURLOPT_USERAGENT, $this->getUserAgent());
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

        $requestHeaders = array(
            'Accept: application/json',
            'Content-Type: application/json',
        );

        if ($fields) {
            $data = json_encode($fields);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            $requestHeaders[] = 'Content-Length: ' . strlen($data);
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $requestHeaders);

        $body = curl_exec($curl);
        $statusCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);

        if (curl_errno($curl) === 0) {
            return $this->generateResponse($statusCode, $body);
        } else {
            throw new Exception('Error while sending request to api: ' . curl_error($curl), Exception::SERVER_UNAVAILABLE, new Response($body, $statusCode));
        }
    }
}
