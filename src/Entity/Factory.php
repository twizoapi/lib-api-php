<?php

namespace Twizo\Api\Entity;

use Twizo\Api\AbstractClient;

/**
 * Entity factory class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Factory
{
    /**
     * @var AbstractClient
     */
    protected $client;

    /**
     * Constructor
     *
     * @param AbstractClient $client
     */
    public function __construct(AbstractClient $client)
    {
        $this->client = $client;
    }

    /**
     * Create empty number lookup object
     *
     * @return NumberLookup
     */
    public function createEmptyNumberLookup()
    {
        return new NumberLookup($this->client);
    }

    /**
     * Create empty sms object
     *
     * @return Sms
     */
    public function createEmptySms()
    {
        $sms = new Sms($this->client);

        return $sms;
    }

    /**
     * Create empty verification object
     *
     * @return Verification
     */
    public function createEmptyVerification()
    {
        return new Verification($this->client);
    }

    /**
     * Create empty widget session object
     *
     * @return WidgetSession
     */
    public function createEmptyWidgetSession()
    {
        return new WidgetSession($this->client);
    }

    /**
     * Create number lookup for numbers
     *
     * @param array $numbers
     *
     * @return NumberLookup
     */
    public function createNumberLookup(array $numbers)
    {
        $numberLookup = $this->createEmptyNumberLookup();
        $numberLookup->setNumbers($numbers);

        return $numberLookup;
    }

    /**
     * Create number lookup poll
     *
     * @return Poll
     */
    public function createNumberLookupPoll()
    {
        return new Poll($this->client, Poll::TYPE_NUMBER_LOOKUP);
    }

    /**
     * Create sms object
     *
     * @param string $body
     * @param array  $recipients
     * @param string $sender
     *
     * @return Sms
     */
    public function createSms($body, array $recipients, $sender)
    {
        $sms = $this->createEmptySms();
        $sms->setBody($body);
        $sms->setRecipients($recipients);
        $sms->setSender($sender);

        return $sms;
    }

    /**
     * Create sms poll object
     *
     * @return Poll
     */
    public function createSmsPoll()
    {
        return new Poll($this->client, Poll::TYPE_SMS);
    }

    /**
     * Create verification object
     *
     * @param string $recipient
     *
     * @return Verification
     */
    public function createVerification($recipient)
    {
        $verification = $this->createEmptyVerification();
        $verification->setRecipient($recipient);

        return $verification;
    }

    /**
     * Create widget session object
     *
     * @param string $recipient
     *
     * @return WidgetSession
     */
    public function createWidgetSession($recipient)
    {
        $widgetSession = $this->createEmptyWidgetSession();
        $widgetSession->setRecipient($recipient);

        return $widgetSession;
    }
}
