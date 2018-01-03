<?php
/**
 * Send a boivoice verification; the number is read from console
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
    $verification->setType($verification::TYPE_BIO_VOICE);
    $verification->send();

    EntityFormatter::dumpEntity($verification);

    print 'Success' . PHP_EOL;
} catch (Twizo\Api\Exception $e) {
    print 'Exception: ' . $e->getMessage() . PHP_EOL;
}
