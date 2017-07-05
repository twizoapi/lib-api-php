<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractClient;
use Twizo\Api\AbstractEntity;

/**
 * Poll entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Poll extends AbstractEntity
{
    // Allowed types of poll objects
    const TYPE_SMS = 'sms';
    const TYPE_NUMBER_LOOKUP = 'numberlookup';

    /**
     * @var string
     */
    protected $batchId;

    /**
     * @var array
     */
    protected $messages;

    /**
     * @var string
     */
    protected $type;

    /**
     * Poll constructor.
     *
     * @param AbstractClient $client
     * @param Factory        $factory
     * @param string         $type
     */
    public function __construct(AbstractClient $client, Factory $factory, $type)
    {
        parent::__construct($client, $factory);

        $this->type = $type;
    }

    /**
     * Delete the poll messages from the server
     */
    public function delete()
    {
        if ($this->batchId !== null) {
            $this->sendApiCall(self::ACTION_REMOVE, $this->getCreateUrl() . '/' . urlencode($this->batchId));
        }
    }

    /**
     * Get the url to create the poll batch
     *
     * @return string
     */
    protected function getCreateUrl()
    {
        return $this->type . '/poll';
    }

    /**
     * Return the poll messages
     *
     * @return array
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * Create entity on server
     *
     * @throws Exception
     */
    public function send()
    {
        $this->sendApiCall(self::ACTION_RETRIEVE, $this->getCreateUrl());
    }

    /**
     * Set the fields for the object
     *
     * @param array $fields
     */
    public function setFields(array $fields)
    {
        parent::setFields($fields);
        if (empty($this->batchId)) {
            $this->batchId = null;
        }

        if (isset($fields['_embedded']['messages'])) {
            $this->messages = $fields['_embedded']['messages'];
        }
    }
}
