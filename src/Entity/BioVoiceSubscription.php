<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractEntity;
use Twizo\Api\Entity\BioVoiceSubscription\EmptyRecipientException;

/**
 * BioVoice subscription entity object
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class BioVoiceSubscription extends AbstractEntity
{
    /**
     * @var null|string
     */
    protected $createdDateTime;

    /**
     * @var null|string
     */
    protected $recipient;

    /**
     * @var null|string
     */
    protected $voiceSentence;

    /**
     * @throw Exception
     */
    public function delete()
    {
        $this->sendApiCall(self::ACTION_REMOVE, $this->getCreateUrl() . '/' . urlencode($this->recipient));
    }

    /**
     * @return string
     */
    protected function getCreateUrl()
    {
        return 'biovoice/subscription';
    }

    /**
     * @return null|string
     */
    public function getCreatedDateTime()
    {
        return $this->createdDateTime;
    }

    /**
     * @return null|string
     */
    public function getRecipient()
    {
        return $this->recipient;
    }

    /**
     * @return null|string
     */
    public function getVoiceSentence()
    {
        return $this->voiceSentence;
    }

    /**
     * @param string $id
     *
     * @throws Exception
     */
    public function populate($id)
    {
        if (empty($id)) {
            throw new EmptyRecipientException();
        }

        $this->sendApiCall(self::ACTION_RETRIEVE, $this->getCreateUrl() . '/' . urlencode($id));
    }
}
