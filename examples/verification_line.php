<?php
/**
 * Send a verification line message; the number is read from console
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

$twizo = Twizo\Api\Twizo::getInstance(SECRET, API_HOST);

try {
    $verification = $twizo->createVerification(readline('Number: '));
    $verification->setType($verification::TYPE_LINE);
    $verification->setIssuer('Twizo PHP Library');
    $verification->send();

    $messageId = $verification->getMessageId();

    print 'Line verification send with message id: ' . $messageId . PHP_EOL;

    while ($verification->getStatusCode() === Verification::STATUS_NO_STATUS) {
        $verification = $twizo->getVerification($messageId);

        sleep(1);
    }

    print 'Result: ' . $verification->getStatus() . PHP_EOL;
} catch (Twizo\Api\Exception $e) {
    print 'Exception: ' . $e->getMessage() . PHP_EOL;
}
