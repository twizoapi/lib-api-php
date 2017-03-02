<?php
/**
 * Send a verification sms; the number is read from console
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
require_once(dirname(__FILE__) . '/util/Bootstrap.php');

use Twizo\Api\Entity\Verification;
use Twizo\Examples\Util\EntityFormatter;

$twizo = Twizo\Api\Twizo::getInstance(SECRET, API_HOST);

try {
    $verification = $twizo->createVerification(readline('Number: '));
    $verification->setType($verification::TYPE_SMS);
    $verification->send();

    EntityFormatter::dumpEntity($verification);

    $token = readline('Token: ');

    $result = $twizo->getTokenResult($verification->getMessageId(), $token);

    print 'Success' . PHP_EOL;
} catch (Verification\Exception $e) {
    switch ($e->getVerificationErrorCode()) {
        case Verification\Exception::ERROR_TOKEN_ALREADY_VERIFIED:
            print 'Token already verified' . PHP_EOL;
            break;
        case Verification\Exception::ERROR_TOKEN_VERIFICATION_EXPIRED:
            print 'Token expired' . PHP_EOL;
            break;
        case Verification\Exception::ERROR_TOKEN_INVALID_TOKEN:
            print 'Token invalid' . PHP_EOL;
            break;
        case Verification\Exception::ERROR_TOKEN_VERIFY_FAILED:
            print 'Token verification failed' . PHP_EOL;
            break;
        default:
            print 'Unknown verification error' . PHP_EOL;
            break;
    }
} catch (Twizo\Api\Exception $e) {
    print 'Exception: ' . $e->getMessage() . PHP_EOL;
}
