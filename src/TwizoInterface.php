<?php

namespace Twizo\Api;

use Twizo\Api\Entity\Application;
use Twizo\Api\Entity\BackupCode;
use Twizo\Api\Entity\Sms;
use Twizo\Api\Entity\NumberLookup;
use Twizo\Api\Entity\Verification;
use Twizo\Api\Entity\WidgetSession;
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
     *
     * @return WidgetSession
     */
    public function createWidgetSession(array $allowedTypes = null, $recipient = null, $backupCodeIdentifier = null);

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
     *
     * @return WidgetSession
     *
     * @throws Exception
     */
    public function getWidgetSession($sessionToken, $recipient = null, $backupCodeIdentifier = null);

    /**
     * Verify token and return true when successful and false when there is an error
     *
     * @param string $messageId
     * @param string $token
     *
     * @return bool
     */
    public function verifyToken($messageId, $token);

    /**
     * Verify credentials by returning the application object
     *
     * @return Application\VerifyCredentials
     *
     * @throws Exception
     */
    public function verifyCredentials();
}
