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
    const LIB_VERSION = '0.11.0';

    /**
     * @var string
     */
    protected $apiHost;

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
     * @param string $verb
     * @param string $location
     * @param array  $fields
     *
     * @return Response
     *
     * @throws Client\Exception
     */
    abstract public function sendRequest($verb, $location, $fields);

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
                throw new ClientException('The requested entity was not found on the server', ClientException::ENTITY_NOT_FOUND, $response);
                break;
            case Response::REST_CLIENT_ERROR_CONFLICT:
                $body = $response->getBody();

                $message = (isset($body['detail'])) ? $body['detail'] : 'The request was rejected due to an conflict.';
                throw new ClientException($message, ClientException::INVALID_RESPONSE, $response);
                break;
            case Response::REST_CLIENT_ERROR_UNPROCESSABLE_ENTITY:
                $body = $response->getBody();

                $message = (isset($body['detail'])) ? $body['detail'] : 'Unable to process the request';
                throw new ClientException($message, ClientException::INVALID_RESPONSE, $response);
                break;
            case Response::REST_CLIENT_ERROR_LOCKED:
                $body = $response->getBody();

                $message = (isset($body['detail'])) ? $body['detail'] : 'The request could not be processed as the entity was locked.';
                throw new ClientException($message, ClientException::INVALID_RESPONSE, $response);
                break;
            case Response::REST_CLIENT_ERROR_TOO_MANY_REQUESTS:
                throw new ClientException('You are sending too fast and your calls are throttled', ClientException::SERVER_UNAVAILABLE, $response);
                break;
            case Response::REST_CLIENT_ERROR_PAYMENT_REQUIRED:
                throw new ClientException('Insufficient credit for your wallet', ClientException::INSUFFICIENT_CREDIT, $response);
                break;
            case Response::REST_SUCCESS_OK:
            case Response::REST_SUCCESS_CREATED:
                break; // Valid response
            default:
                throw new ClientException(sprintf('Unknown status code %d received from server', $response->getStatusCode()), ClientException::INVALID_RESPONSE, $response);
                break;
        }
    }
}
