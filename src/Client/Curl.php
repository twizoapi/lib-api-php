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
            curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($fields));
            $requestHeaders[] = 'Content-Length: ' . strlen(json_encode($fields));
        }

        curl_setopt($curl, CURLOPT_HTTPHEADER, $requestHeaders);

        $body = curl_exec($curl);
        $statusCode = (int) curl_getinfo($curl, CURLINFO_HTTP_CODE);

        $response = $this->generateResponse($statusCode, $body);

        if (curl_errno($curl)) {
            throw new Exception('Error while sending request to api: ' . curl_error($curl), Exception::SERVER_UNAVAILABLE, $response);
        }

        return $response;
    }

    /**
     * Add curl version to user agent
     *
     * @return array
     */
    public function getUserAgentInfo()
    {
        $curlVersion = curl_version();

        return array_merge(parent::getUserAgentInfo(), array('curl-no-guzzle/' . $curlVersion["version"], 'php/' . phpversion()));
    }
}
