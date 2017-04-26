<?php

namespace Twizo\Api;

use Twizo\Api\Client\Exception as ClientException;

/**
 * Abstract client class to connect to the api server
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
abstract class AbstractClient
{
    const API_USERNAME = 'twizo';
    const API_VERSION = 'v1';
    const LIB_VERSION = '0.1.0';

    /**
     * @var string
     */
    protected $apiHost;

    /**
     * @var AbstractClient|null
     */
    protected static $instance;

    /**
     * @var string
     */
    protected $secret;

    /**
     * Constructor
     *
     * @param string $secret
     * @param string $apiHost
     */
    public function __construct($secret, $apiHost)
    {
        $this->secret = $secret;
        $this->apiHost = $apiHost;
    }

    /**
     * Return new client instance
     *
     * @param string $secret
     * @param string $apiHost
     *
     * @return AbstractClient
     *
     * @throws ClientException
     */
    public static function getInstance($secret, $apiHost)
    {
        if (self::$instance === null) {
            if (class_exists('GuzzleHttp\Client')) {
                self::$instance = new Client\Guzzle($secret, $apiHost);
            } elseif (function_exists('curl_version')) {
                self::$instance = new Client\Curl($secret, $apiHost);
            } else {
                throw new ClientException('No guzzle or curl was found', ClientException::NO_CURL_OR_GUZZLE_FOUND);
            }
        }

        return self::$instance;
    }

    /**
     * Get full url for a location
     *
     * @param string $location
     *
     * @return string
     */
    public function getUrl($location)
    {
        return sprintf('https://%s/%s/%s', $this->apiHost, self::API_VERSION, $location);
    }

    /**
     * @return string
     */
    public function getUserAgent()
    {
        return implode(' ', $this->getUserAgentInfo());
    }

    /**
     * @return array
     */
    public function getUserAgentInfo()
    {
        return array(
            'Twizo-php-lib/' . self::LIB_VERSION,
        );
    }

    /**
     * Validate response from server
     *
     * @param Response $response
     *
     * @throws ClientException
     */
    protected function validateServerResponse(Response $response)
    {
        switch ($response->getStatusCode()) {
            case Response::REST_CLIENT_ERROR_UNAUTHORIZED:
                throw new ClientException('You have provided an invalid API key', ClientException::INVALID_APPLICATION_SECRET, $response);
                break;
            case Response::REST_CLIENT_ERROR_FORBIDDEN:
                throw new ClientException('Your account is not enabled for the service', ClientException::INVALID_APPLICATION_SECRET, $response);
                break;
            case Response::REST_CLIENT_ERROR_NOT_FOUND:
                throw new ClientException('The requested entity was not found on the server', ClientException::INVALID_RESPONSE, $response);
                break;
            case Response::REST_CLIENT_ERROR_TOO_MANY_REQUESTS:
                throw new ClientException('You are sending too fast and your calls are throttled', ClientException::SERVER_UNAVAILABLE, $response);
                break;
            case Response::REST_SUCCESS_OK:
            case Response::REST_SUCCESS_CREATED:
                break; // Valid response
            default:
                throw new ClientException(sprintf('Unknown status code %d received from server', $response->getStatusCode()), ClientException::INVALID_RESPONSE, $response);
                break;
        }
    }

    /**
     * Decode json array and convert it to an array
     *
     * @param int    $statusCode
     * @param string $json
     *
     * @return Response
     *
     * @throws ClientException
     */
    protected function generateResponse($statusCode, $json)
    {
        if (empty($json) && $statusCode == Response::REST_SUCCESS_NO_CONTENT) {
            return new Response(array(), $statusCode);
        } else {
            $body = json_decode($json, true);
            if ($body == null) {
                throw new ClientException('Error while sending request to api; Received invalid json: ' . $json, ClientException::SERVER_UNAVAILABLE);
            }
            $response = new Response($body, $statusCode);
            $this->validateServerResponse($response);

            return $response;
        }
    }

    /**
     * @param string $verb
     * @param string $location
     * @param array  $fields
     *
     * @return Response
     *
     * @throws Client\Exception
     */
    abstract public function sendRequest($verb, $location, $fields);
}
