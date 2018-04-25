<?php

namespace Twizo\Api;

use Twizo\Api\Entity\Application;
use Twizo\Api\Entity\BackupCode;
use Twizo\Api\Entity\BioVoiceRegistration;
use Twizo\Api\Entity\BioVoiceSubscription;
use Twizo\Api\Entity\Factory;
use Twizo\Api\Entity\NumberLookup;
use Twizo\Api\Entity\Sms;
use Twizo\Api\Entity\Totp;
use Twizo\Api\Entity\Verification;
use Twizo\Api\Entity\WidgetSession;
use Twizo\Api\Entity\WidgetRegisterSession;
use Twizo\Api\Entity\Balance;

/**
 * Main Twizo class
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
class Twizo implements TwizoInterface
{
    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @var Twizo[][]
     */
    protected static $instances = array();

    /**
     * Twizo constructor.
     *
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Create backup code for the supplied identifier
     *
     * @param string $identifier
     *
     * @return BackupCode
     */
    public function createBackupCode($identifier)
    {
        $backupCode = $this->factory->createBackupCode($identifier);

        return $backupCode;
    }

    /**
     * Create bio voice registration for the supplied recipient
     *
     * @param string      $recipient
     * @param string|null $language
     * @param string|null $webHook
     *
     * @return BioVoiceRegistration
     */
    public function createBioVoiceRegistration($recipient, $language = null, $webHook = null)
    {
        $bioVoiceRegistration = $this->factory->createBioVoiceRegistration($recipient, $language, $webHook);

        return $bioVoiceRegistration;
    }

    /**
     * Create number lookup for the supplied number(s)
     *
     * @param string|array $numbers
     *
     * @return NumberLookup
     */
    public function createNumberLookup($numbers)
    {
        if (is_array($numbers)) {
            $numberLookup = $this->factory->createNumberLookup($numbers);
        } else {
            $numberLookup = $this->factory->createNumberLookup(array($numbers));
        }

        return $numberLookup;
    }

    /**
     * Create sms for the supplied recipient(s)
     *
     * @param string       $body
     * @param string|array $recipients
     * @param string       $sender
     *
     * @return Sms
     */
    public function createSms($body, $recipients, $sender)
    {
        if (is_array($recipients)) {
            $sms = $this->factory->createSms($body, $recipients, $sender);
        } else {
            $sms = $this->factory->createSms($body, array($recipients), $sender);
        }

        return $sms;
    }

    /**
     * Create TOTP secret
     *
     * @param string      $identifier
     * @param string|null $issuer
     *
     * @return Entity\Totp
     */
    public function createTotp($identifier, $issuer = null)
    {
        $totp = $this->factory->createTotp($identifier, $issuer);

        return $totp;
    }

    /**
     * Create verification for the supplied recipient
     *
     * @param string $recipient
     *
     * @return Verification
     */
    public function createVerification($recipient)
    {
        $verification = $this->factory->createVerification($recipient);

        return $verification;
    }

    /**
     * Create widget session with the supplied data
     *
     * @param array|null  $allowedTypes
     * @param string|null $recipient
     * @param string|null $backupCodeIdentifier
     * @param string|null $totpIdentifier
     * @param string|null $issuer
     *
     * @return WidgetSession
     */
    public function createWidgetSession(array $allowedTypes = null, $recipient = null, $backupCodeIdentifier = null, $totpIdentifier = null, $issuer = null)
    {
        $widgetSession = $this->factory->createWidgetSession($allowedTypes, $recipient, $backupCodeIdentifier, $totpIdentifier, $issuer);

        return $widgetSession;
    }

    /**
     * Create widget register session with the supplied data
     *
     * @param array|null  $allowedTypes
     * @param string|null $recipient
     * @param string|null $backupCodeIdentifier
     * @param string|null $totpIdentifier
     * @param string|null $issuer
     *
     * @return WidgetRegisterSession
     */
    public function createWidgetRegisterSession(array $allowedTypes = null, $recipient = null, $backupCodeIdentifier = null, $totpIdentifier = null, $issuer = null)
    {
        $widgetRegisterSession = $this->factory->createWidgetRegisterSession($allowedTypes, $recipient, $backupCodeIdentifier, $totpIdentifier, $issuer);

        return $widgetRegisterSession;
    }

    /**
     * Get backup code status for the supplied identifier
     *
     * @param string $identifier
     *
     * @return BackupCode
     *
     * @throws Exception
     */
    public function getBackupCode($identifier)
    {
        $backupCode = $this->factory->createEmptyBackupCode();
        $backupCode->populate($identifier);

        return $backupCode;
    }

    /**
     * Return the current account balance
     *
     * @return Balance
     */
    public function getBalance()
    {
        $balance = $this->factory->createEmptyBalance();
        $balance->loadData();

        return $balance;
    }

    /**
     * Get bio voice registration status for the supplied registrationId
     *
     * @param string $registrationId
     *
     * @return BioVoiceRegistration
     *
     * @throws Exception
     */
    public function getBioVoiceRegistration($registrationId)
    {
        $bioVoiceRegistration = $this->factory->createEmptyBioVoiceRegistration();
        $bioVoiceRegistration->populate($registrationId);

        return $bioVoiceRegistration;
    }

    /**
     * Get bio voice subscription status for the supplied recipient
     *
     * @param string $recipient
     *
     * @return BioVoiceSubscription
     * @throws Exception
     */
    public function getBioVoiceSubscription($recipient)
    {
        $bioVoiceSubscription = $this->factory->createEmptyBioVoiceSubscription();
        $bioVoiceSubscription->populate($recipient);

        return $bioVoiceSubscription;
    }

    /**
     * Get a new Twizo instance
     *
     * @param string $secret
     * @param string $apiHost
     *
     * @return TwizoInterface
     */
    public static function getInstance($secret, $apiHost)
    {
        if (!isset(self::$instances[$secret][$apiHost])) {
            self::$instances[$secret][$apiHost] = new self(
                new Entity\Factory(
                    new Client\Curl($secret, $apiHost)
                )
            );
        }

        return self::$instances[$secret][$apiHost];
    }

    /**
     * Get number lookup status for the supplied message id
     *
     * @param string $messageId
     *
     * @return NumberLookup
     *
     * @throws Exception
     */
    public function getNumberLookup($messageId)
    {
        $numberLookup = $this->factory->createEmptyNumberLookup();
        $numberLookup->populate($messageId);

        return $numberLookup;
    }

    /**
     * Get number lookup polling results; returns only results for messages which have result type polling enabled
     *
     * @return array
     *
     * @throws Exception
     */
    public function getNumberLookupResults()
    {
        $numberLookupPoll = $this->factory->createNumberLookupPoll();
        $numberLookupPoll->send();
        $resultList = array();

        foreach ($numberLookupPoll->getMessages() as $message) {
            $resultList[] = $numberLookup = $this->factory->createEmptyNumberLookup();
            $numberLookup->setFields($message);
        }

        $numberLookupPoll->delete();

        return $resultList;
    }

    /**
     * Get sms status for the supplied message id
     *
     * @param string $messageId
     *
     * @return Sms
     *
     * @throws Exception
     */
    public function getSms($messageId)
    {
        $sms = $this->factory->createEmptySms();
        $sms->populate($messageId);

        return $sms;
    }

    /**
     * Get sms polling results; returns only results for messages which have result type polling enabled
     *
     * @return Sms[]
     *
     * @throws Exception
     */
    public function getSmsResults()
    {
        $smsPoll = $this->factory->createSmsPoll();
        $smsPoll->send();
        $resultList = array();

        foreach ($smsPoll->getMessages() as $message) {
            $resultList[] = $sms = $this->factory->createEmptySms();
            $sms->setFields($message);
        }

        $smsPoll->delete();

        return $resultList;
    }

    /**
     * Verify token and return the verification object when successfully verified; otherwise return an exception
     *
     * @param string $messageId
     * @param string $token
     *
     * @return Verification
     *
     * @throws Exception
     */
    public function getTokenResult($messageId, $token)
    {
        $verification = $this->factory->createEmptyVerification();
        $verification->verify($token, $messageId);

        return $verification;
    }

    /**
     * Get totp status for the supplied identifier
     *
     * @param string $identifier
     *
     * @return Totp
     *
     * @throws Exception
     */
    public function getTotp($identifier)
    {
        $totp = $this->factory->createEmptyTotp();
        $totp->populate($identifier);

        return $totp;
    }

    /**
     * Get verification status for the supplied message id
     *
     * @param string $messageId
     *
     * @return Verification
     *
     * @throws Exception
     */
    public function getVerification($messageId)
    {
        $verification = $this->factory->createEmptyVerification();
        $verification->populate($messageId);

        return $verification;
    }

    /**
     * Get verification types allowed for the supplied credentials
     *
     * @return Application\VerificationTypes
     *
     * @throws Exception
     */
    public function getVerificationTypes()
    {
        $verificationTypes = $this->factory->createEmptyApplicationVerificationTypes();
        $verificationTypes->loadData();

        return $verificationTypes;
    }

    /**
     * Get widget session status for the supplied session token
     *
     * @param string      $sessionToken
     * @param string|null $recipient
     * @param string|null $backupCodeIdentifier
     * @param string|null $totpIdentifier
     *
     * @return WidgetSession
     *
     * @throws Exception
     */
    public function getWidgetSession($sessionToken, $recipient = null, $backupCodeIdentifier = null, $totpIdentifier = null)
    {
        $widgetSession = $this->factory->createEmptyWidgetSession();
        $widgetSession->populate($sessionToken, $recipient, $backupCodeIdentifier, $totpIdentifier);

        return $widgetSession;
    }

    /**
     * Get widget register session status for the supplied session token
     *
     * @param string $sessionToken
     *
     * @return WidgetRegisterSession
     *
     * @throws Exception
     */
    public function getWidgetRegisterSession($sessionToken)
    {
        $widgetRegisterSession = $this->factory->createEmptyWidgetRegisterSession();
        $widgetRegisterSession->populate($sessionToken);

        return $widgetRegisterSession;
    }

    /**
     * Verify credentials by returning the application object
     *
     * @return Application\VerifyCredentials
     *
     * @throws Exception
     */
    public function verifyCredentials()
    {
        $verifyCredentials = $this->factory->createEmptyApplicationVerifyCredentials();
        $verifyCredentials->loadData();

        return $verifyCredentials;
    }

    /**
     * Verify token and return true when successful and false when there is an error
     *
     * @param string $messageId
     * @param string $token
     *
     * @return bool
     */
    public function verifyToken($messageId, $token)
    {
        try {
            $verification = $this->getTokenResult($messageId, $token);

            return ($verification->getStatusCode() === Verification::STATUS_SUCCESS);
        } catch (Exception $e) {
            return false;
        }
    }
}
