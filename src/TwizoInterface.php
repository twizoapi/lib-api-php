<?php

namespace Twizo\Api;

use Twizo\Api\Entity\Application;
use Twizo\Api\Entity\BackupCode;
use Twizo\Api\Entity\BioVoiceRegistration;
use Twizo\Api\Entity\BioVoiceSubscription;
use Twizo\Api\Entity\Sms;
use Twizo\Api\Entity\NumberLookup;
use Twizo\Api\Entity\Totp;
use Twizo\Api\Entity\Verification;
use Twizo\Api\Entity\WidgetSession;
use Twizo\Api\Entity\WidgetRegisterSession;
use Twizo\Api\Entity\Balance;

/**
 * Interface for Twizo
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
interface TwizoInterface
{
    /**
     * Create backup code for the supplied identifier
     *
     * @param string $identifier
     *
     * @return BackupCode
     */
    public function createBackupCode($identifier);

    /**
     * Create bio voice registration
     *
     * @param string      $recipient
     * @param string|null $language
     * @param string|null $webHook
     *
     * @return BioVoiceRegistration
     */
    public function createBioVoiceRegistration($recipient, $language = 'en', $webHook = null);

    /**
     * Create number lookup for the supplied number(s)
     *
     * @param string|array $numbers
     *
     * @return NumberLookup
     */
    public function createNumberLookup($numbers);

    /**
     * Create sms for the supplied recipient(s)
     *
     * @param string       $body
     * @param string|array $recipients
     * @param string       $sender
     *
     * @return Sms
     */
    public function createSms($body, $recipients, $sender);

    /**
     * Create TOTP secret
     *
     * @param string      $identifier
     * @param string|null $issuer
     *
     * @return Entity\Totp
     */
    public function createTotp($identifier, $issuer = null);

    /**
     * Create verification for the supplied recipient
     *
     * @param string $recipient
     *
     * @return Verification
     */
    public function createVerification($recipient);

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
    public function createWidgetSession(array $allowedTypes = null, $recipient = null, $backupCodeIdentifier = null, $totpIdentifier = null, $issuer = null);

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
    public function createWidgetRegisterSession(array $allowedTypes = null, $recipient = null, $backupCodeIdentifier = null, $totpIdentifier = null, $issuer = null);

    /**
     * Get backup code status for the supplied identifier
     *
     * @param string $identifier
     *
     * @return BackupCode
     *
     * @throws Exception
     */
    public function getBackupCode($identifier);

    /**
     * Get bio voice registration status for the supplied registrationId
     *
     * @param string $registrationId
     *
     * @return BioVoiceRegistration
     * @throw Exception
     */
    public function getBioVoiceRegistration($registrationId);

    /**
     * Get bio voice subscription status for the supplied recipient
     *
     * @param string $recipient
     *
     * @return BioVoiceSubscription
     * @throws Exception
     */
    public function getBioVoiceSubscription($recipient);

    /**
     * Return the current account balance
     *
     * @return Balance
     */
    public function getBalance();

    /**
     * Get number lookup status for the supplied message id
     *
     * @param string $messageId
     *
     * @return NumberLookup
     *
     * @throws Exception
     */
    public function getNumberLookup($messageId);

    /**
     * Get number lookup polling results; returns only results for messages which have result type polling enabled
     *
     * @return array
     *
     * @throws Exception
     */
    public function getNumberLookupResults();

    /**
     * Get sms status for the supplied message id
     *
     * @param string $messageId
     *
     * @return Sms
     *
     * @throws Exception
     */
    public function getSms($messageId);

    /**
     * Get sms polling results; returns only results for messages which have result type polling enabled
     *
     * @return Sms[]
     *
     * @throws Exception
     */
    public function getSmsResults();

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
    public function getTokenResult($messageId, $token);

    /**
     * Get totp status for the supplied identifier
     *
     * @param string $identifier
     *
     * @return Totp
     *
     * @throws Exception
     */
    public function getTotp($identifier);

    /**
     * Get verification status for the supplied message id
     *
     * @param string $messageId
     *
     * @return Verification
     *
     * @throws Exception
     */
    public function getVerification($messageId);

    /**
     * Get verification types allowed for the supplied credentials
     *
     * @return Application\VerificationTypes
     *
     * @throws Exception
     */
    public function getVerificationTypes();

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
    public function getWidgetSession($sessionToken, $recipient = null, $backupCodeIdentifier = null, $totpIdentifier = null);

    /**
     * Get widget register session status for the supplied session token
     *
     * @param string $sessionToken
     *
     * @return WidgetRegisterSession
     *
     * @throws Exception
     */
    public function getWidgetRegisterSession($sessionToken);

    /**
     * Verify credentials by returning the application object
     *
     * @return Application\VerifyCredentials
     *
     * @throws Exception
     */
    public function verifyCredentials();

    /**
     * Verify token and return true when successful and false when there is an error
     *
     * @param string $messageId
     * @param string $token
     *
     * @return bool
     */
    public function verifyToken($messageId, $token);
}
