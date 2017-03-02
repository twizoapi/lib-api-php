<?php

namespace Twizo\Api\Client;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\RequestException;
use Twizo\Api\AbstractClient;
use Twizo\Api\Response;

/**
 * Guzzle client class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Guzzle extends AbstractClient
{
    /**
     * @var GuzzleClient
     */
    protected $guzzle;

    /**
     * Constructor
     *
     * @param string       $secret
     * @param string       $apiHost
     * @param GuzzleClient $guzzle
     */
    public function __construct($secret, $apiHost, GuzzleClient $guzzle = null)
    {
        parent::__construct($secret, $apiHost);

        if ($this->guzzle === null) {
            $this->guzzle = new GuzzleClient();
        }
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
        $options = array();

        // Set authentication parameters
        $options['auth'] = array(self::API_USERNAME, $this->secret);

        // Don't throw exceptions on 4xx errors
        $options['exceptions'] = false;

        // Add body to request
        $options['json'] = $fields;

        // Set other headers
        $options['headers'] = array();
        $options['headers']['Accept'] = 'application/json';
        $options['headers']['Content-Type'] = 'application/json';
        $options['headers']['User-Agent'] = $this->getUserAgent();

        $request = $this->guzzle->createRequest($verb, $this->getUrl($location), $options);

        try {
            $guzzleResult = $this->guzzle->send($request);

            $response = $this->generateResponse($guzzleResult->getStatusCode(), $guzzleResult->getBody()->getContents());

            return $response;
        } catch (RequestException $e) {
            $response = null;
            if ($e->hasResponse()) {
                $response = $this->generateResponse($e->getResponse()->getStatusCode(), $e->getResponse()->getBody());
            }

            throw new Exception('Error while sending request to api: ' . $e->getMessage(), Exception::SERVER_UNAVAILABLE, $response);
        }
    }

    /**
     * Add default guzzle user agent to user agent string
     *
     * @return array
     */
    public function getUserAgentInfo()
    {
        $guzzleOptions = $this->guzzle->getDefaultOption();
        if (isset($guzzleOptions['headers']['User-Agent'])) {
            return array_merge(parent::getUserAgentInfo(), array($guzzleOptions['headers']['User-Agent']));
        } else {
            return parent::getUserAgentInfo();
        }
    }
}
