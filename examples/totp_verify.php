<?php
/**
 * Verify a totp token after a secret has been generated
 *
 * This file is part of the Twizo php api
 *
 * (c) Twizo <info@twizo.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * File that was distributed with this source code.
 */
require_once(dirname(__FILE__) . '/util/Bootstrap.php');

use Twizo\Api\Entity;
use Twizo\Api\Entity\Totp;
use Twizo\Examples\Util\EntityFormatter;

$twizo = Twizo\Api\Twizo::getInstance(SECRET, API_HOST);

print "[Create totp]" . PHP_EOL;
$totp = $twizo->createTotp(readline('Identifier: '), readline('Issuer: '));
$totp->create();

print PHP_EOL;
EntityFormatter::dumpEntity($totp);
print PHP_EOL;

print "[Verify totp code]" . PHP_EOL;
try {
    $totp->verify(readline('Code: '));
    EntityFormatter::dumpEntity($totp);

    print PHP_EOL . "Totp verified!" . PHP_EOL;
} catch (Totp\Exception $ex) {
    printf(
        "Totp\Exception occurred: [%s] %s" . PHP_EOL,
        $ex->getStatusCode(),
        $ex->getMessage()
    );
} catch (Entity\Exception $ex) {
    printf(
        "Totp occurred: [%s] %s" . PHP_EOL,
        $ex->getStatusCode(),
        $ex->getMessage()
    );
}