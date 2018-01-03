<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractEntity;

/**
 * Totp entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Totp extends AbstractEntity
{
    /**
     * @var string
     */
    protected $identifier;

    /**
     * @var string
     */
    protected $issuer;

    /**
     * @var string
     */
    protected $uri;

    /**
     * @var string
     */
    protected $verificationMessageId;

    /**
     * @param string $identifier
     */
    public function setIdentifier($identifier)
    {
        $this->identifier = $identifier;
        $this->addPostField('identifier');
    }

    /**
     * @throws Exception
     */
    public function create()
    {
        $this->sendApiCall(self::ACTION_CREATE, $this->getCreateUrl());
    }

    /**
     * @throws Exception
     */
    public function delete()
    {
        $this->sendApiCall(self::ACTION_REMOVE, $this->getCreateUrl() . '/' . urlencode($this->identifier));
    }

    /**
     * @param string $id
     *
     * @throws Exception
     */
    public function populate($id)
    {
        if (empty($id)) {
            throw new Exception('No identifier supplied for totp', Totp\Exception::NO_IDENTIFIER_SUPPLIED);
        }

        $this->sendApiCall(self::ACTION_RETRIEVE, $this->getCreateUrl() . '/' . urlencode($id));
    }

    /**
     * @throws Exception
     */
    public function update()
    {
        $this->sendApiCall(self::ACTION_UPDATE, $this->getCreateUrl() . '/' . urlencode($this->identifier));
    }

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'totp';
    }

    /**
     * @return string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getIssuer()
    {
        return $this->issuer;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return string
     */
    public function getVerificationMessageId()
    {
        return $this->verificationMessageId;
    }

    /**
     * @param string $issuer
     */
    public function setIssuer($issuer)
    {
        $this->issuer = $issuer;
        $this->addPostField('issuer');
    }

    /**
     * @param string      $token
     * @param string|null $identifier
     *
     * @throws Exception
     */
    public function verify($token, $identifier = null)
    {
        $identifier = ($identifier !== null) ? $identifier : $this->identifier;

        // Throw error for empty token or empty message id, because the server will not handle this
        if (empty($token)) {
            throw new Totp\EmptyTokenException();
        }
        if (empty($this->identifier)) {
            throw new Totp\EmptyIdentifierException();
        }

        try {
            $this->sendApiCall(self::ACTION_RETRIEVE, sprintf('totp/%s?token=%s', $identifier, $token));
        } catch (Exception $e) {
            if (Totp\Exception::isTotpException($e)) {
                throw new Totp\Exception($e);
            } else {
                throw $e;
            }
        }
    }
}
